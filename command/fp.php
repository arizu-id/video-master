<?php
$filenya = "";
if ($handle = opendir('data/fb_page/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $ukuran = formatFileSize("data/fb_page/$entry");
            $bjorya = str_replace(".txt",'',$entry);
$filenya .= "`$bjorya` ($ukuran)
";
        }
    }
    closedir($handle);
}
if(!isset($filenya) or $filenya != ""){
    sM("[REPLY] To : $chatId -> (list cookie)");
    sendMessage($chatId, $messageId, $filenya);
}else{
    $respon = "no images found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}