<?php
$nama_cookies = $isiPerintah[0];
$video = $isiPerintah[0];
if(!$nama_cookies){
    $respon = "Please insert your session name";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!$video){
    $respon = "Please insert your video file";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("data/tiktok_cookies/$nama_cookies.txt")){
    $respon = "session name not found, try send me /tt_list";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("files/video/$video")){
    $respon = "video not found, try send me /storage";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    $respon = "Sorry, python auto upload not available for now!";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}