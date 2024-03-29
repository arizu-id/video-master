<?php
$video = $isiPerintah[0];
$cookies = $isiPerintah[1];
$caption = $isiPerintah[2];
if(!file_exists("files/video/$video")){
    $respon = "Video not found, try type /storage";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage2($chatId, $messageId, $respon);
}else
if(!file_exists("data/fb_page/$cookies.txt")){
    $respon = "Cookies not found, try type /fp";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage2($chatId, $messageId, $respon);
}else
if(!$caption){
    $respon = "Please insert video caption, example : hello_guys_#viral_#fyp";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage2($chatId, $messageId, $respon);
}else{
    $caption = str_replace('_',' ',$caption);
    $cmmds = 'node modules/reels-uploader/upload.js "files/video/'.$video.'" "'.$caption.'" "data/fb_page/'.$cookies.'.txt"';
    echo $cmmds.PHP_EOL;
    shell_exec($cmmds);
$respon = "Video : `$video`
Cookies : `$cookies`
Caption : $caption

If the video fails to upload, there may be an update on Instagram";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage($chatId, $messageId, $respon);
}