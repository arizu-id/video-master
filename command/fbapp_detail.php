<?php
if(file_exists('facebook_app.ini')){
    $datafbapp = json_decode(file_get_contents('facebook_app.ini'),true);
$respon = "APP ID = $datafbapp[app_id]
APP Secret Key = $datafbapp[app_secret]";  
    sM("[REPLY] To : $chatId -> (fb_app data)");
    sendMessage($chatId, $messageId, $respon); 
}else{
    $respon = "Failed to read configuration file, try add configuration /fbapp_set [app_id] [app_secret]";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}
?>