<?php
$nama_cookies = $isiPerintah[0];
$folder = "data/tiktok_cookies/";
if(!$nama_cookies){
    $respon = "Please insert cookies name";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage2($chatId, $messageId, $respon);
}else{
    $file_id = $pesan['message']['document']['file_id'];
    if(isset($file_id)){
        $beka = getFile($file_id);
        $ekse = json_decode($beka,true);
        if(isset($ekse['result']['file_path'])){
            if(downloadAndSaveFile($ekse['result']['file_path'],"$folder$nama_cookies.txt") == true){
                $respon = "Cookies has been saved as $nama_cookies";
                sM("[REPLY] To : $chatId -> $respon");
                sendMessage2($chatId, $messageId, $respon);
            }else{
                $respon = "Server failed to save file";
                sM("[REPLY] To : $chatId -> $respon");
                sendMessage2($chatId, $messageId, $respon);
            }
        }else{
            $respon = "Server failed to get file from bot";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage2($chatId, $messageId, $respon);
        }        
    }else{
        $respon = "Please send file (txt) with type command /tt_save [name]";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage2($chatId, $messageId, $respon);
    }
}
?>