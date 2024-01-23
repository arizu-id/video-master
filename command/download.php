<?php
$url_videos = $isiPerintah[0];
$respon = "Proses..";
sM("[REPLY] To : $chatId -> $respon");
$proses_pesan = sendMessage($chatId, $messageId, $respon);
$req = getVideo($url_videos);
$gabol = json_decode($req,true);
sM("[!] Vidio -> $gabol[url]");
$filename = "videos".rand(1000,9999)."_".strtotime("now").".mp4";
if(downloadFiles($gabol['url'],"tmp/$filename") == true){
    sM("Download Success -> tmp/$filename");
    if(sendStream($chatId, $messageId, "tmp/$filename") == true){
        sM("[REPLY] To : $chatId -> (video_file)");
    }else{
        $respon = "Server Gagal Mengirim Video";
        sM("[REPLY] To : $chatId -> $respon");;
        sendMessage($chatId, $messageId, $respon);
    }
    
}else{
    $respon = "Server tidak dapat mengunduh video!";
    sM("[REPLY] To : $chatId -> $respon");
    deleteMessage($chatId, $messageId, $respon);
}
$proses_ekstrak = json_decode($proses_pesan,true);
deleteMessage($proses_ekstrak['result']['chat']['id'], $proses_ekstrak['result']['message_id']);