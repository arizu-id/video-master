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
                    $message = $pesan['message']['text'];
                    $chatId = $pesan['message']['chat']['id'];
                    $messageId = $pesan['message']['message_id'];
                    $username = $pesan['message']['chat']['username'];
                    sM("[Message] From : $chatId ($username) -> $message");
                    $message = str_replace('  ',' ',$message);
				    $commandMatches = detectCommand($message);
                    if (!empty($commandMatches)) {
                        $commandName = $commandMatches[1];
                        $commandArguments = isset($commandMatches[3]) ? $commandMatches[3] : '';					
                        $isiPerintah = explode(' ',$commandArguments);
                        $commandName2 = explode(' ',$commandName);
                        $commandName = $commandName2[0];
                        if($commandName == 'start'){
                            sM("[REPLY] To : $chatId -> (welcome message)");
                            sendMessage($chatId, $messageId, welcomeMessage());	
                        }else
                        if($commandName == 'help'){
                            sM("[REPLY] To : $chatId -> (help)");
                            sendMessage($chatId, $messageId, helpMessage());	
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
