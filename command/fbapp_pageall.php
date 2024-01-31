<?php
$filenya = "";
if ($handle = opendir('data/fb_page/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $entry = str_replace('.txt','',$entry);
$filenya .= "`$entry`
";
        }
    }
    closedir($handle);
}
if(!isset($filenya) or $filenya != ""){
    sM("[REPLY] To : $chatId -> (list audio)");
    sendMessage($chatId, $messageId, $filenya);
}else{
    $respon = "no audio found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}