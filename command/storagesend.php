<?php
$fileaudio = $isiPerintah[0];
if(file_exists("files/video/$fileaudio")){
    if(sendStream($chatId, $messageId, "files/video/$fileaudio") == true){
        sM("[REPLY] To : $chatId -> (audio_file)");
    }else{
        $respon = "Server Gagal Mengirim Video (try short duration)";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}else{
    $respon = "Video not found!";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}