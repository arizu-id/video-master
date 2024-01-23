<?php
$nama = $isiPerintah[0];
if(!$nama){
    $respon = "Command is incorrect, try typing /help";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    if(file_exists("files/audio/$nama")){
        if(unlink("files/audio/$nama")){
            $respon = "Audio has been successfully deleted";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }else{
            $respon = "Audio failed to delete";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }
    }else{
        $respon = "Audio not found on server";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}