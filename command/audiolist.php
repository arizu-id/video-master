<?php
$filenya = "";
if ($handle = opendir('files/audio/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $ukuran = formatFileSize("files/audio/$entry");
$filenya .= "$entry ($ukuran)
";
        }
    }
    closedir($handle);
}
if(!isset($filenya) or $filenya != ""){
    sM("[REPLY] To : $chatId -> (list audio)");
    sendMessage($chatId, $messageId, $filenya);
}else{
    $filenya = "no audio found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}