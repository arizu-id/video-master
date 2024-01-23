<?php
$fileaudio = $isiPerintah[0];
if(file_exists("files/audio/$fileaudio")){
    if(sendStreamAudio($chatId, $messageId, "files/audio/$fileaudio") == true){
        sM("[REPLY] To : $chatId -> (audio_file)");
    }else{
        $respon = "Server Gagal Mengirim Audio (try short duration)";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}else{
    $respon = "Audio not found!";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}