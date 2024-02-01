<?php
function cls_force(){
    echo "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";

echo "    ██╗░░░██╗██╗██████╗░███████╗░█████╗░  ███╗░░░███╗░█████╗░░██████╗████████╗███████╗██████╗░\n";
echo "    ██║░░░██║██║██╔══██╗██╔════╝██╔══██╗  ████╗░████║██╔══██╗██╔════╝╚══██╔══╝██╔════╝██╔══██╗\n";
echo "    ╚██╗░██╔╝██║██║░░██║█████╗░░██║░░██║  ██╔████╔██║███████║╚█████╗░░░░██║░░░█████╗░░██████╔╝\n";
echo "    ░╚████╔╝░██║██║░░██║██╔══╝░░██║░░██║  ██║╚██╔╝██║██╔══██║░╚═══██╗░░░██║░░░██╔══╝░░██╔══██╗\n";
echo "    ░░╚██╔╝░░██║██████╔╝███████╗╚█████╔╝  ██║░╚═╝░██║██║░░██║██████╔╝░░░██║░░░███████╗██║░░██║\n";
echo "    ░░░╚═╝░░░╚═╝╚═════╝░╚══════╝░╚════╝░  ╚═╝░░░░░╚═╝╚═╝░░╚═╝╚═════╝░░░░╚═╝░░░╚══════╝╚═╝░░╚═╝\n";
echo "\n\n\n";
}
function checkBot($token){
    $ch = curl_init("https://api.telegram.org/bot{$token}/getMe");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    if($data['ok'] == true){
        return true;
    }else{
        return false;
    }
}
function getToken($file){
    if(file_exists($file)){
        $botToken = json_decode(trim(file_get_contents($file)),true);
        if(isset($botToken['bot_token'])){
            if(checkBot($botToken['bot_token'])==true){
                return $botToken['bot_token'];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function sM($message){
    echo "$message\n";
}
function checkDir(){
    if(!is_dir("tmp")){
        mkdir("tmp");
    }
    if(!is_dir("tmp2")){
        mkdir("tmp2");
    }
    if(!is_dir("tmp3")){
        mkdir("tmp3");
    }
    if(!is_dir("tmp4")){
        mkdir("tmp4");
    }
    if(!is_dir("tmp5")){
        mkdir("tmp5");
    }
    if(!is_dir("render")){
        mkdir("render");
    }
    if(!is_dir("files")){
        mkdir("files");
    }
    if(!is_dir("files/audio")){
        mkdir("files/audio");
    }
    if(!is_dir("files/images")){
        mkdir("files/images");
    }
    if(!is_dir("files/video")){
        mkdir("files/video");
    }
    if(!is_dir("data")){
        mkdir("data");
    }
    if(!is_dir("data/fb_page")){
        mkdir("data/fb_page");
    }
    if(!file_exists("terbaru.txt")){
        file_put_contents("terbaru.txt","0");
    }
}
function detectCommand($text) {
    $pattern = '/^\/([a-zA-Z0-9_]+)(\s(.*))?$/';
    preg_match($pattern, $text, $matches);
    return $matches;
}
function getVideo($urlvideo){
	$uri = "https://co.wuk.sh/api/json";
	$bbx = array();
	$bbx['url'] = $urlvideo;
	$bbx['aFormat'] = "mp3";
	$bbx['filenamePattern'] = "classic";
	$bbx['dubLang'] = false;
	$bbx['vQuality'] = "1080";
	$headers = array();
	$headers[] = 'Accept:application/json';
	$headers[] = 'Content-Type:application/json';
	$headers[] = 'Cache-Control:no-cache';	
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($bbx));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 99999);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function getYTMusic($urlvideo){
	$uri = "https://co.wuk.sh/api/json";
	$bbx = array();
	$bbx['url'] = $urlvideo;
	$bbx['aFormat'] = "mp3";
	$bbx['filenamePattern'] = "classic";
	$bbx['isAudioOnly'] = true;
	$bbx['dubLang'] = false;
	$bbx['vQuality'] = "1080";
	$headers = array();
	$headers[] = 'Accept:application/json';
	$headers[] = 'Content-Type:application/json';
	$headers[] = 'Cache-Control:no-cache';	
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($bbx));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function getName($uri){
	$pisah = basename($uri);
	$meki = explode('?',$pisah);
	return $meki[0];
}
function downloadFiles($url,$file){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$fileContent = curl_exec($ch);
	if ($fileContent === false) {
		return false;
	}else{
		file_put_contents($file, $fileContent);
		return true;
	}
}
function getMessageLatest(){
	$uri = "https://api.telegram.org/bot" . BOT_TOKEN . "/getUpdates";
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function getMessage2($terbaru){
	$uri = "https://api.telegram.org/bot" . BOT_TOKEN . "/getUpdates?offset=$terbaru";
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function formatFileSize($filename) {
    $size = filesize($filename);

    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $formattedSize = $size;

    for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
        $size /= 1024;
        $formattedSize = round($size, 2);
    }

    return $formattedSize . ' ' . $units[$i];
}
function welcomeMessage(){
$pesan = "Welcome to Video Master, Video Master is a tool that helps you speed up the time for editing a video, generally if you edit a video from collecting materials or assets to the rendering stage it takes 5-10 minutes at the fastest. However, with this tool you only need 2-5 minutes (depending on your server specifications).

By using this tool you agree not to involve the developer (Arizu Studio) in any form of copyright claims for anything done by the user.

To start using the bot you can type /help to see the commands.";
return $pesan;
}
function helpMessage(){
$pesan = "Auto Download & Editing Videos
/download [url]
/flip [url]

Watermark Module
/wm [url_video] [opacity] [size] [position_y] [position_x] [images]
/wma [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
/wma_border [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume] [borderColor] [borderSize]
/wm_ca [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
/wmf [url_video] [opacity] [size] [position_y] [position_x] [images]
/wmfa [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
/wmfa_border [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume] [borderColor] [borderSize]
/wmf_ca [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]

Preset Module
/preset [name] [INPUT_1] [INPUT_2] [INPUT_3] [INPUT_4]
/preset_sv [name] [command]
/preset_all
/preset_send [name]
/preset_del [name]

Facebook APP Settings
/fbapp_detail
/fbapp_set [app_id] [app_secret]

Facebook Page Settings
/fbapp_pageall
/fbapp_pageset [name] [token] [page_id]
/fbapp_pagedel [name]

Auto Post
/p_fbpage [PageApp] [video] [caption]

List Video Saved on Server
/storage
/storageclean
/storagesend [filename]

List File Thumbnail on Server
/thumbnaildelete
/thumbnaillist
/thumbnailsave [url] [filename]
/thumbnailsend [filename]

List File Audio on Server
/audiodelete [filename]
/audiolist
/audiosave [url] [filename]
/audiosend [filename]
/audioyt [url] [filename]";
    return $pesan;
}