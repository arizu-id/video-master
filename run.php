<?php

include "function/func.php";
$token = getToken("configuration.ini");
include "function/telegram.php";
if($token == false){
    sM("[!] Failed to verify Telegram Bot Token..");
}else{
    sM("[+] Token : $token");
    define('BOT_TOKEN', $token);
    sM("[+] BOT Connected..");
    checkDir();
    start:
    $terbaru = file_get_contents('terbaru.txt');
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
                        if($commandName == 'start' or $commandName == 'help'){
                            sM("[REPLY] To : $chatId -> (help)");
                            sendMessage($chatId, $messageId, helpMessage());	
                        }else
                        if($commandName == 'download'){
                            $url_videos = $isiPerintah[0];
                            $respon = "Proses..";
                            sM("[REPLY] To : $chatId -> $respon");
                            $proses_pesan = sendMessage($chatId, $messageId, $respon);
                            $req = getVideo($url_videos);
                            $gabol = json_decode($req,true);
                            sM("[!] Vidio -> $gabol[url]");
                            $filename = "videos".rand(1000,9999)."_".strtotime("now").".mp4";
                            if(downloadFiles($gabol['url'],"tmp/$filename") == true){
                                sM("Download Success -> tmp/$filename");
                                if(sendStream($chatId, $messageId, "tmp/$filename") == true){
                                    sM("[REPLY] To : $chatId -> (video_file)");
                                }else{
                                    $respon = "Server Gagal Mengirim Video";
                                    sM("[REPLY] To : $chatId -> $respon");;
                                    sendMessage($chatId, $messageId, $respon);
                                }
                                
                            }else{
                                $respon = "Server tidak dapat mengunduh video!";
                                sM("[REPLY] To : $chatId -> $respon");
                                deleteMessage($chatId, $messageId, $respon);
                            }
                            $proses_ekstrak = json_decode($proses_pesan,true);
                            deleteMessage($proses_ekstrak['result']['chat']['id'], $proses_ekstrak['result']['message_id']);
                        }else
                        if($commandName == 'thumbnailsave'){
                            $file_audio = $isiPerintah[0];
                            $nama = $isiPerintah[1];
                            if(!$file_audio or !$nama){
                                $respon = "Command is incorrect, try typing /help";
					            sM("[REPLY] To : $chatId -> $respon");
					            sendMessage($chatId, $messageId, $respon);
                            }else{
                                if(downloadFiles($file_audio,"files/images/$nama") == true){
                                    $respon = "New images saved as $nama";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }else{
                                    $respon = "Failed to save images";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }
                            }
                        }else
                        if($commandName == 'thumbnailsend'){
                            $fileaudio = $isiPerintah[0];
                            if(file_exists("files/images/$fileaudio")){
                                if(sendImages($chatId, $messageId, "files/images/$fileaudio") == true){
                                    sM("[REPLY] To : $chatId -> (images_file)");
                                }else{
                                    $respon = "Failed to send images (try small size)";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }
                            }else{
                                $respon = "images not found!";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage($chatId, $messageId, $respon);
                            }
                        }else
                        if($commandName == 'thumbnaillist'){
                            $filenya = "";
                            if ($handle = opendir('files/images/')) {
                                while (false !== ($entry = readdir($handle))) {
                                    if ($entry != "." && $entry != "..") {
$filenya .= "$entry
";
                                    }
                                }
                                closedir($handle);
                            }
                            if(!isset($filenya) or $filenya != ""){
                                sM("[REPLY] To : $chatId -> (list images)");
                                sendMessage($chatId, $messageId, $filenya);
                            }else{
                                $filenya = "no images found";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage($chatId, $messageId, $respon);
                            }
                        }else
                        if($commandName == 'audiosave'){
                            $file_audio = $isiPerintah[0];
                            $nama = $isiPerintah[1];
                            if(!$file_audio or !$nama){
                                $respon = "Command is incorrect, try typing /help";
					            sM("[REPLY] To : $chatId -> $respon");
					            sendMessage($chatId, $messageId, $respon);
                            }else{
                                if(downloadFiles($file_audio,"files/audio/$nama") == true){
                                    $respon = "New audio saved as $nama";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }else{
                                    $respon = "Failed to save audio";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }
                            }
                        }else
                        if($commandName == 'audioyt'){
                            $file_audio = $isiPerintah[0];
                            $nama = $isiPerintah[1];
                            if(!$file_audio or !$nama){
                                $respon = "Command is incorrect, try typing /help";
					            sM("[REPLY] To : $chatId -> $respon");
					            sendMessage($chatId, $messageId, $respon);
                            }else{
                                $req = getYTMusic($file_audio);
                                $gabol = json_decode($req,true);
                                sM("[!] Audio -> $gabol[url]");
                                if(downloadFiles($gabol['url'],"files/audio/$nama") == true){
                                    $respon = "New audio saved as $nama";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }else{
                                    $respon = "Failed to save audio";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }
                            }
                        }else
                        if($commandName == 'audiolist'){
                            $filenya = "";
                            if ($handle = opendir('files/audio/')) {
                                while (false !== ($entry = readdir($handle))) {
                                    if ($entry != "." && $entry != "..") {
$filenya .= "$entry
";
                                    }
                                }
                                closedir($handle);
                            }
                            if(!isset($filenya) or $filenya != ""){
                                sM("[REPLY] To : $chatId -> (list audio)");
                                sendMessage($chatId, $messageId, $filenya);
                            }else{
                                $filenya = "no audio found";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage($chatId, $messageId, $respon);
                            }
                        }else
                        if($commandName == 'audiosend'){
                            $fileaudio = $isiPerintah[0];
                            if(file_exists("files/audio/$fileaudio")){
                                if(sendStreamAudio($chatId, $messageId, "files/audio/$fileaudio") == true){
                                    sM("[REPLY] To : $chatId -> (audio_file)");
                                }else{
                                    $respon = "Server Gagal Mengirim Audio (try short duration)";
                                    sM("[REPLY] To : $chatId -> $respon");
                                    sendMessage($chatId, $messageId, $respon);
                                }
                            }else{
                                $respon = "Audio not found!";
                                sM("[REPLY] To : $chatId -> $respon");
                                sendMessage($chatId, $messageId, $respon);
                            }
                        }else{
                            $respon = "Command not found, try typing /help";
					        sM("[REPLY] To : $chatId -> $respon");
					        sendMessage($chatId, $messageId, $respon);
                        }
                    }else{
                        $respon = "Command not found, try typing /help";
					    sM("[REPLY] To : $chatId -> $respon");
					    sendMessage($chatId, $messageId, $respon);
                    }
                }
                file_put_contents('terbaru.txt',$update_id);
                goto start;
            }else{
                sM("[!]No New Message..");
                sleep(0.75);
                goto start;
            }
            sM("===============================================================================");
        }else{
            sleep(0.75);
            goto start;
        }
    }else{
        sM("[!] failed to update data..");
        goto start;
    }
}
?>