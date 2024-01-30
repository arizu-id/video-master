<?php
$filepreset = $isiPerintah[0];
$filepresettxt = "$filepreset.txt";
if(file_exists("files/prompt/$filepresettxt")){
    if(unlink("files/prompt/$filepresettxt")){
        $respon = "preset has been deleted";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }else{
        $respon = "failed to delete preset";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}else{
    $respon = "preset not found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}
?>