<?php
$filenya = "";
if ($handle = opendir('files/video/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $ukuran = formatFileSize("files/video/$entry");
$filenya .= "$entry ($ukuran)
";
        }
    }
    closedir($handle);
}
if(!isset($filenya) or $filenya != ""){
    sM("[REPLY] To : $chatId -> (list video)");
    sendMessage($chatId, $messageId, $filenya);
}else{
    $respon = "no video found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}