<?php
$url_video = $isiPerintah[0];
$opacity = $isiPerintah[1];
$size = $isiPerintah[2];
$position_y = $isiPerintah[3];
$position_x = $isiPerintah[4];
$images = $isiPerintah[5];
$audio = $isiPerintah[6];
$volume = $isiPerintah[7];
$borderColor = $isiPerintah[8];
$borderSize = $isiPerintah[9];
if(!$url_video or !$opacity or !$size or !$position_y or !$position_x or !$images or !$audio or !$volume or !$borderColor or !$borderSize){
    $respon = "Command is incorrect, try typing /help";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if($opacity < 0 or $opacity > 1){
    $respon = "The range for opacity is 0-1, example : 0.75";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if($position_y < 1 or $position_y > 10){
    $respon = "The range for position y 1-10, example : 2";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if($position_x < 1 or $position_x > 10000){
    $respon = "The range for position x 1-10000, example : 2";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if($volume < 0 or $volume > 1){
    $respon = "The range for backsound volume is 0-1, example : 0.25";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("files/images/$images")){
    $respon = "Thumbnail not found, try typing /thumbnaillist";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("files/audio/$audio")){
    $respon = "Audio not found, try typing /audiolist";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    $position_y = 10-$position_y;
    $respon = "Proses..";
    $filename = "videos_".rand(1000,9999)."_".strtotime("now").".mp4";
    if(file_exists("files/video/$url_video")){
        $gabol = array();
        $gabol['url'] = "files/video/$url_video";
    }else{
        $req = getVideo($url_video);
        $gabol = json_decode($req,true);
    }
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
        shell_exec('ffmpeg -i tmp/'.$filename.' -i files/images/'.$images.' -i files/audio/'.$audio.' -filter_complex "[2]volume='.$volume.'[a2];[1]colorchannelmixer=aa='.$opacity.',scale='.$size.':-1[wm];[0][wm]overlay=(main_w-overlay_w)/'.$position_x.':(main_h-overlay_h)/'.$position_y.',[0:a][a2]amix=inputs=2" -c:v libx264 -tune stillimage -c:a mp3 -b:a 192k -pix_fmt yuv420p -shortest -map 0:v:0 tmp2/'.$filename);
        if(file_exists("tmp2/$filename")){
            sM("Add Watermark..");
            shell_exec('ffmpeg -i tmp2/'.$filename.' -i files/images/'.$images.' -filter_complex "[1]colorchannelmixer=aa='.$opacity.',scale='.$size.':-1[wm];[0][wm]overlay=(main_w-overlay_w)/'.$position_x.':(main_h-overlay_h)/'.$position_y.'" tmp3/'.$filename);
            if(file_exists("tmp3/$filename")){
                shell_exec('ffmpeg -i tmp3/'.$filename.' -filter_complex "[0]pad=w='.$borderSize.'+iw:h='.$borderSize.'+ih:x='.$borderSize.'/2:y='.$borderSize.'/2:color='.$borderColor.'" render/'.$filename);
                if(file_exists("render/$filename")){
                    sM("Sending..");
                    if(sendStream($chatId, $messageId, "render/$filename") == true){
                        sM("[REPLY] To : $chatId -> (video_file)");
                    }else{
                        $respon = "Failed to send video!";
                        sM("[REPLY] To : $chatId -> $respon");
                        sendMessage($chatId, $messageId, $respon);
                    }  
                    copy("render/$filename", "files/video/$filename");
                    sendMessage($chatId, $messageId, "saved on server as `$filename`");
                    if(unlink("render/$filename")){
                        sM("[!] Video File Deleted");
                    }else{
                        sM("[!] Failed to Delete Audio File");
                    }
                }else{
                    $respon = "Failed to editing video (err: step 3)!";
                    sM("[REPLY] To : $chatId -> $respon");
                    sendMessage($chatId, $messageId, $respon);
                }              
                if(unlink("tmp3/$filename")){
                    sM("[!] Video File Deleted");
                }else{
                    sM("[!] Failed to Delete Audio File");
                }
            }else{
                $respon = "Failed to editing video (err: step 2)!";
                sM("[REPLY] To : $chatId -> $respon");
                sendMessage($chatId, $messageId, $respon);
            }
            if(unlink("tmp2/$filename")){
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
