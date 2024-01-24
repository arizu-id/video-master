<?php
$filenya = "";
if ($handle = opendir('files/video/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            unlink("files/video/$entry");
        }
    }
    closedir($handle);
}

    $respon = "storage has been cleaned";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
