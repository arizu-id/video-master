<?php
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