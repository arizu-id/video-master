<?php
$filenya = "";
if ($handle = opendir('files/images/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $ukuran = formatFileSize("files/images/$entry");
$filenya .= "$entry ($ukuran)
";
        }
    }
    closedir($handle);
}
if(!isset($filenya) or $filenya != ""){
    sM("[REPLY] To : $chatId -> (list images)");
    sendMessage($chatId, $messageId, $filenya);
}else{
    $filenya = "no images found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}