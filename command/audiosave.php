<?php
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