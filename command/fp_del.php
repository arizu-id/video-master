<?php
$nama = $isiPerintah[0];
if(!$nama){
    $respon = "Command is incorrect, try typing /help";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    if(file_exists("data/fb_page/$nama.txt")){
        if(unlink("data/fb_page/$nama.txt")){
            $respon = "Cookies has been successfully deleted";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }else{
            $respon = "Cookies failed to delete";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }
    }else{
        $respon = "Cookies not found";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}