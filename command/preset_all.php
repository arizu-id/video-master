<?php
$filenya = "";
if ($handle = opendir('files/prompt/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $entry = str_replace('.txt','',$entry);
$filenya .= "$entry
";
        }
    }
    closedir($handle);
}
if(!isset($filenya) or $filenya != ""){
    sM("[REPLY] To : $chatId -> (list preset)");
    sendMessage($chatId, $messageId, $filenya);
}else{
    $respon = "no preset found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}