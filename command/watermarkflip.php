<?php
$url_video = $isiPerintah[0];
$opacity = $isiPerintah[1];
$size = $isiPerintah[2];
$position_y = $isiPerintah[3];
$position_x = $isiPerintah[4];
$images = $isiPerintah[5];
if(!$url_video or !$opacity or !$size or !$position_y or !$position_x or !$images){
    $respon = "Command is incorrect, try typing /help";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("files/images/$images")){
    $respon = "Thumbnail not found, try typing /thumbnaillist";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    $respon = "Proses..";
    $filename = "videos_".rand(1000,9999)."_".strtotime("now").".mp4";
    $req = getVideo($url_video);
    $gabol = json_decode($req,true);
	sM("[REPLY] To : $chatId -> $respon");
	$proses_pesan = sendMessage($chatId, $messageId, $respon);
    if(!$gabol['url']){
        $respon = "Failed to get video source!";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }else
    if(downloadFiles($gabol['url'],"tmp/$filename") == true){
        sM("Download Success -> tmp/$filename");
        sM("Editing..");
        shell_exec('ffmpeg -i tmp/'.$filename.' -i files/images/'.$images.' -filter_complex "[1]colorchannelmixer=aa='.$opacity.',scale='.$size.':-1[wm];[0][wm]overlay=(main_w-overlay_w)/'.$position_x.':(main_h-overlay_h)/'.$position_y.',hflip" render/'.$filename);
        if(file_exists("render/$filename")){
            sM("Sending..");
            if(sendStream($chatId, $messageId, "render/$filename") == true){
                sM("[REPLY] To : $chatId -> (video_file)");
            }else{
                $respon = "Failed to send video!";
                sM("[REPLY] To : $chatId -> $respon");
                sendMessage($chatId, $messageId, $respon);
            }
            if(unlink("render/$filename")){
                sM("[!] Video File Deleted");
            }else{
                sM("[!] Failed to Delete Audio File");
            }
        }else{
            $respon = "Failed to editing video!";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }
        if(unlink("tmp/$filename")){
            sM("[!] Video File Deleted");
        }else{
            sM("[!] Failed to Delete Audio File");
        }
    }else{
        $respon = "Server tidak dapat mengunduh video!";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
    $proses_ekstrak = json_decode($proses_pesan,true);
	deleteMessage($proses_ekstrak['result']['chat']['id'], $proses_ekstrak['result']['message_id']);
}
