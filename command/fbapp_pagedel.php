<?php
$name = $isiPerintah[0];
if(!$name){
    $respon = "Please insert your session name";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(file_exists("data/fb_page/$name.txt")){
    if(unlink("data/fb_page/$name.txt")){
        $respon = "session has been deleted";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }else{
        $respon = "failed to delete session";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}else{
    $respon = "session name not found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}
?>