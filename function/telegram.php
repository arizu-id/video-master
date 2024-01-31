<?php

function deleteMessage($chatId, $messageId){
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage";
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/deleteMessage?chat_id=$chatId&message_id=$messageId";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    $response = curl_exec($ch);
    curl_close($ch);
    $update = json_decode($response,true);
	if ($update['ok'] == true) {
		return true;
	}else{
		return false;
	}
}
function sendMessage($chatId, $messageId, $message){
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage";
    $params = [
        'chat_id' => $chatId,
        'text' => $message,
        'reply_to_message_id' => $messageId,
        'disable_notification' => true,
        'parse_mode' => "markdown"
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    return $response = curl_exec($ch);
    curl_close($ch);
    //$update = json_decode($response,true);
	//if ($update['ok'] == true) {
	//	return true;
	//}else{
	//	return false;
	//}
}
function sendVideo($chatId, $messageId, $videoUri){
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendVideo";
    $params = [
        'chat_id' => $chatId,
        'video' => $videoUri,
        'reply_to_message_id' => $messageId,
        'disable_notification' => true
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    $response = curl_exec($ch);
    curl_close($ch);
    $update = json_decode($response,true);
	if ($update['ok'] == true) {
		return true;
	}else{
		return false;
	}
}
function sendStream($chatId, $messageId, $videoPath){
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendVideo";
    $params = [
        'chat_id' => $chatId,
        'video' => new CURLFile($videoPath),
        'reply_to_message_id' => $messageId,
        'disable_notification' => true
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    $response = curl_exec($ch);
    curl_close($ch);
    $update = json_decode($response,true);
	if ($update['ok'] == true) {
		return true;
	}else{
		return false;
	}
}
function sendImages($chatId, $messageId, $img){
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
    $params = [
        'chat_id' => $chatId,
        'photo' =>  new CURLFile($img),
        'reply_to_message_id' => $messageId,
        'disable_notification' => true
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    $response = curl_exec($ch);
    curl_close($ch);
    $update = json_decode($response,true);
	if ($update['ok'] == true) {
		return true;
	}else{
		return false;
	}
}
function sendDocument($chatId, $messageId, $videoPath){
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
    $params = [
        'chat_id' => $chatId,
        'document' => new CURLFile($videoPath),
        'reply_to_message_id' => $messageId,
        'disable_notification' => true
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    $response = curl_exec($ch);
    curl_close($ch);
    $update = json_decode($response,true);
	if ($update['ok'] == true) {
		return true;
	}else{
		return false;
	}
}
function sendStreamAudio($chatId, $messageId, $audioPath){
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendAudio";
    $params = [
        'chat_id' => $chatId,
        'audio' => new CURLFile($audioPath),
        'reply_to_message_id' => $messageId,
        'disable_notification' => true
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    $response = curl_exec($ch);
    curl_close($ch);
    $update = json_decode($response,true);
	if ($update['ok'] == true) {
		return true;
	}else{
		return false;
	}
}