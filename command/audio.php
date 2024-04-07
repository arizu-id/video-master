<?php
$audio = $isiPerintah[1];
$video = $isiPerintah[0];
$volume = $isiPerintah[2];
if(!$video or !$audio or !$volume){
    $respon = "Command is incorrect, try typing /help";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("files/video/$video")){
    $respon = "Thumbnail not found, try typing /thumbnaillist";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("files/audio/$audio")){
    $respon = "Audio not found, try typing /audiolist";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    $respon = "Proses..";
	sM("[REPLY] To : $chatId -> $respon");
	$proses_pesan = sendMessage($chatId, $messageId, $respon);
    $filename = "videos_".rand(1000,9999)."_".strtotime("now").".mp4";
 //   shell_exec('ffmpeg '.$vga.' -i files/video/'.$video.' -i files/audio/'.$audio.' -filter_complex "[1]volume=0.5[a2];[0:a][a2]amix=inputs=2" -c:v libx264 -tune stillimage -c:a mp3 -b:a 192k -pix_fmt yuv420p -shortest -map 0:v:0 render/'.$filename);
    shell_exec('ffmpeg '.$vga.' -i files/video/'.$video.' -i files/audio/'.$audio.' -filter_complex "[1:0]volume='.$volume.'[a1];[0:a][a1]amix=inputs=2;" -c:v libx264 -tune stillimage -c:a mp3 -b:a 192k -pix_fmt yuv420p -shortest -map 0:v:0 render/'.$filename);
    if(file_exists("render/$filename")){
        if(sendStream($chatId, $messageId, "render/$filename") == true){
            sM("[REPLY] To : $chatId -> (video_file)");
            copy("render/$filename", "files/video/$filename");
            sendMessage($chatId, $messageId, "saved on server as `$filename`");
            if(unlink("render/$filename")){
                sM("[!] Video File Deleted");
            }else{
                sM("[!] Failed to Delete video File");
            }
        }else{
            $respon = "Failed to send video!";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }      
        
    }else{
        $respon = "Failed to editing video!";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
    $proses_ekstrak = json_decode($proses_pesan,true);
	deleteMessage($proses_ekstrak['result']['chat']['id'], $proses_ekstrak['result']['message_id']);
}
