<?php
$nama = $isiPerintah[0];
if(!$nama){
    $respon = "Command is incorrect, try typing /help";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    if(file_exists("files/images/$nama")){
        if(unlink("files/images/$nama")){
            $respon = "Images has been successfully deleted";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }else{
            $respon = "Images failed to delete";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }
    }else{
        $respon = "Images not found on server";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}