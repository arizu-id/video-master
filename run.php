<?php
//error_reporting(0);
include "function/func.php";
$token = getToken("configuration.ini");
include "function/telegram.php";
cls_force();
setup:
if(!file_exists("configuration.ini")){
    echo "[?] Enter your BOT Token : ";
    $inputToken = trim(fgets(STDIN));
    if(checkBot($inputToken) == true){
        $saveToken = array();
        $saveToken['bot_token'] = $inputToken;
        file_put_contents("configuration.ini",json_encode($saveToken));
        sM("[+] Configuration File has been created..");
        $token = $inputToken;
    }else{
        sM("[!] Invalid BOT Token");
    }
}
sM("[+] Starting BOT..");
if($token == false){
    sM("[!] Failed to verify Telegram Bot Token..");
}else{    
    define('BOT_TOKEN', $token);
    sM("[+] BOT Connected..");
    checkDir();
    $latestMessage = getMessageLatest();
    if(!file_exists('key.ini')){
        $mykey = random_num(6);
        file_put_contents('key.ini',$mykey);
        sM("[+] Server secret key generated..");
        sM("[+] Server Key : $mykey");
    }
    if(!file_exists('terbaru.txt')){
        file_put_contents('terbaru.txt','0');
    }
    if ($latestMessage === false) {
        file_put_contents('terbaru.txt','0');
    }else{
        $latestMessageData = json_decode($latestMessage, true);
        if ($latestMessageData['ok']) {
            $updateLatest = $latestMessageData['result'];
            if(count($latestMessageData['result']) > 1){
                file_put_contents('terbaru.txt',end($updateLatest)['update_id']);
            }else{
                file_put_contents('terbaru.txt','0');
            }
        }else{
            file_put_contents('terbaru.txt','0');
        }
    }
    sM("[+] Starting executing command..");
    $tgl = '0';
    start:
    $terbaru = file_get_contents('terbaru.txt');
    //$terbaru = $terbaru+1;
    $update = json_decode(getMessage2($terbaru+1),true);
    if ($update['ok'] == true) {
        if(isset($update['result'][0]['update_id'])){
            $update_id = $update['result'][0]['update_id'];
            if($update_id > $terbaru){
                sM("[$update_id]=====================================================================");
                foreach($update['result'] as $pesan){
                    if(isset($pesan['message']['text'])){
                        $message = $pesan['message']['text'];
                    }else{
                        $message = $pesan['message']['caption'];
                    }
                    $chatId = $pesan['message']['chat']['id'];
                    $messageId = $pesan['message']['message_id'];
                    $username = $pesan['message']['chat']['username'];
                    $userid = $pesan['message']['from']['id'];
                    sM("[Message] From : $chatId ($username) -> $message");
                    $message = str_replace('  ',' ',$message);
				    $commandMatches = detectCommand($message);
                    if($tgl != gmdate("d")){
                        $ch123 = curl_init();
                        curl_setopt($ch123, CURLOPT_URL, "https://raw.githubusercontent.com/arizu-id/video-master/main/version.json");
                        curl_setopt($ch123, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch123, CURLOPT_FOLLOWLOCATION, false);
                        curl_setopt($ch123, CURLOPT_ENCODING, 'gzip, deflate');
                        curl_setopt($ch123, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
                        $response123 = curl_exec($ch123);
                        curl_close($ch);
                        $updated = json_decode($response123,true);
                        $my_vesion = json_decode(file_get_contents('version.json'),true);
                        if($updated['version_id']>$my_vesion['version_id']){
                            $respon = "New version $updated[version_name] available, please update at https://github.com/arizu-id/video-master";
                            sM("[REPLY] To : $chatId -> $respon");
                            sendMessage($chatId, $messageId, $respon);
                        }
                        $tgl = gmdate("d");
                    }
                    if (!empty($commandMatches)) {
                        $commandName = $commandMatches[1];
                        $commandArguments = isset($commandMatches[3]) ? $commandMatches[3] : '';					
                        $isiPerintah = explode(' ',$commandArguments);
                        $commandName2 = explode(' ',$commandName);
                        $commandName = $commandName2[0];
                        if($commandName == 'start'){
                            sM("[REPLY] To : $chatId -> (welcome message)");
                            sendMessage2($chatId, $messageId, welcomeMessage());	
                        }else
                        if($commandName == 'register'){
                            $datakey = trim(file_get_contents('key.ini'));
                            $addkey = $isiPerintah[0];
                            if(file_exists("user/$userid")){
                                $respon = "You're already registered";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage2($chatId, $messageId, $respon);
                            }else
                            if(!$addkey){
                                $respon = "Please insert Server Key, run /register [server_key]";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage2($chatId, $messageId, $respon);
                            }else
                            if($addkey == "$datakey"){
                                file_put_contents("user/$userid",$userid);
                                $respon = "Register success, now you can use this bot! type /help to view all commands";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage2($chatId, $messageId, $respon);
                            }else{
                                $respon = "Invalid secret key";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage2($chatId, $messageId, $respon);
                            }	
                            $addkey = 0;

                            $respon = "By using this service you agree to bear all forms of risk and free the developer from all forms of legal claims, This tool is free and you can download it at https://github.com/arizu-id/video-master";
                            sM("[REPLY] To : $chatId -> $respon");
                            sendMessage($chatId, $messageId, $respon);
                        }else
                        if(!file_exists("user/$userid")){
                            $respon = "You're not authorized, please register! run /register [server_key]";
                            sM("[REPLY] To : $chatId -> $respon");
                            sendMessage2($chatId, $messageId, $respon);
                        }else
                        if($commandName == 'code'){
                            $datakey = trim(file_get_contents('key.ini'));
                            $respon = "Server key : $datakey";
                            sM("[REPLY] To : $chatId -> $respon");
                            sendMessage2($chatId, $messageId, $respon);
                        }else
                        if($commandName == 'recode'){
                            $mykey2 = random_num(6);
                            file_put_contents('key.ini',$mykey2);
                            $respon = "New Server key : $mykey2";
                            sM("[REPLY] To : $chatId -> $respon");
                            sendMessage2($chatId, $messageId, $respon);
                        }else
                        if($commandName == 'help'){
                            sM("[REPLY] To : $chatId -> (help)");
                            sendMessage2($chatId, $messageId, helpMessage());	
                        }else
                        if(file_exists("command/$commandName.php")){
                            include "command/$commandName.php";
                        }else{
                            $respon = "Command file /$commandName not found, try typing /help";
					        sM("[REPLY] To : $chatId -> $respon");
					        sendMessage($chatId, $messageId, $respon);
                        }
                    }else{
                        $respon = "Command /$commandName not found, try typing /help";
					    sM("[REPLY] To : $chatId -> $respon");
					    sendMessage($chatId, $messageId, $respon);
                    }
                }
                file_put_contents('terbaru.txt',$update_id);
                goto start;
            }else{
                //sM("[!]No New Message..");
                sleep(1);
                goto start;
            }
            sM("===============================================================================");
        }else{
            //sM("[!]No New Message at $terbaru..");
            sleep(1);
            goto start;
        }
    }else{
        sM("[!] failed to update data..");
        goto start;
    }
}
?>
