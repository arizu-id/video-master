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
    sM("Editing..");
	shell_exec('ffmpeg -i tmp/'.$filename.' -filter_complex "[0]hflip" render/'.$filename);
	if(file_exists("render/$filename")){
		sM("[!] Sending..");
		if(sendStream($chatId, $messageId, "render/$filename") == true){
			sM("[REPLY] To : $chatId -> (video_file)");
		}else{
			$respon = "Server Gagal Mengirim Video\n";
			sM("[REPLY] To : $chatId -> $respon");
			sendMessage($chatId, $messageId, $respon);
		}
		if(unlink("render/$filename")){
			sM("[!] Edited File Deleted");
		}else{
			sM("[!] Failed to Delete Edited File");
		}
	}else{
		$respon = "Server Gagal Mengedit Video";
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
    deleteMessage($chatId, $messageId, $respon);
}
$proses_ekstrak = json_decode($proses_pesan,true);
deleteMessage($proses_ekstrak['result']['chat']['id'], $proses_ekstrak['result']['message_id']);