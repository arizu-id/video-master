<?php
function cobaltserv(){
    return "https://us2-co.wuk.sh/api/json";
}









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
function random_chars($length){
	$data = 'abcdefghijklmnopqrstuvwxyz1234567890';
	$string = '';
	for($i = 0; $i < $length; $i++) {
		$pos = rand(0, strlen($data)-1);
		$string .= $data[$pos];
	}
	return $string;
}
function random_num($length){
	$data = '1234567890';
	$string = '';
	for($i = 0; $i < $length; $i++) {
		$pos = rand(0, strlen($data)-1);
		$string .= $data[$pos];
	}
	return $string;
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
    if(!is_dir("command_pro")){
        mkdir("command_pro");
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
    if(!is_dir("user")){
        mkdir("user");
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
function igDownload1($url){
	$headers = array();
	$headers[] = 'Cache-Control:no-cache';	
	$headers[] = 'authority: api.sssgram.com';	
	$headers[] = 'method: GET';	
	$headers[] = 'path: /st-tik/ins/dl?url='.$url.'&timestamp=1713346223995';	
	$headers[] = 'scheme: https';	
	$headers[] = 'Accept: application/json, text/plain, */*';	
	$headers[] = 'Origin: https://www.sssgram.com';	
	$headers[] = 'Referer: https://www.sssgram.com/';	
	$headers[] = 'Sec-Ch-Ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"';	
	$headers[] = 'Sec-Ch-Ua-Mobile: ?0';	
	$headers[] = 'Sec-Ch-Ua-Platform: "Windows"';	
	$headers[] = 'Sec-Fetch-Dest: empty';	
	$headers[] = 'Sec-Fetch-Mode: cors';	
	$headers[] = 'Sec-Fetch-Site: same-site';	
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36';	
    $ch = curl_init("https://api.sssgram.com/st-tik/ins/dl?url=$url&timestamp=1713346223995");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);	
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 99999);
    return $response = curl_exec($ch);
}
function getVideo($urlvideo){
	$uri = cobaltserv();
	$bbx = array();
	$bbx['url'] = $urlvideo;
	$bbx['aFormat'] = "mp3";
	$bbx['filenamePattern'] = "classic";
	$bbx['dubLang'] = false;
	$bbx['vQuality'] = "720";
	$headers = array();
	$headers[] = 'Accept:application/json';
	$headers[] = 'Content-Type:application/json';
	$headers[] = 'Cache-Control:no-cache';	
	$headers[] = 'Accept-Encoding: gzip, deflate';
	$headers[] = 'Accept-Language: en-US,en;q=0.9';
	$headers[] = 'Origin: https://cobalt.tools';
	$headers[] = 'Referer: https://cobalt.tools/';
	$headers[] = 'Sec-Ch-Ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"';
	$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
	$headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
	$headers[] = 'Sec-Fetch-Dest: empty';
	$headers[] = 'Sec-Fetch-Mode: cors';
	$headers[] = 'Sec-Fetch-Site: cross-site';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36';
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
    $parse = parse_url($urlvideo);
    $genada = json_decode($response,true);
    "[debugger] host : ".$parse['host'].PHP_EOL;
    if(!isset($genada['url']) && $parse['host'] == 'www.instagram.com'){
        echo "[debugger] Downloading using api.sssgram.com \n";
        $responsesdsd = json_decode(igDownload1($urlvideo),true);
        if(isset($responsesdsd['result']['insBos'][0]['url'])){
            $response = array();
            $response['url'] = $responsesdsd['result']['insBos'][0]['url'];
            $response = json_encode($response);
            echo "[debugger] file url ".$responsesdsd['result']['insBos'][0]['url']." \n";
        }else{
            echo "[debugger] file url not found \n";
        }
    }
    return $response;
}
function getVideo69($urlvideo){
	$uri = cobaltserv();
	$bbx = array();
	$bbx['url'] = $urlvideo;
	$bbx['aFormat'] = "mp3";
	$bbx['filenamePattern'] = "classic";
	$bbx['dubLang'] = false;
	$bbx['vQuality'] = "720";
	$headers = array();
	$headers[] = 'Accept:application/json';
	$headers[] = 'Content-Type:application/json';
	$headers[] = 'Cache-Control:no-cache';	
	$headers[] = 'Accept-Encoding: gzip, deflate';
	$headers[] = 'Accept-Language: en-US,en;q=0.9';
	$headers[] = 'Origin: https://cobalt.tools';
	$headers[] = 'Referer: https://cobalt.tools/';
	$headers[] = 'Sec-Ch-Ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"';
	$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
	$headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
	$headers[] = 'Sec-Fetch-Dest: empty';
	$headers[] = 'Sec-Fetch-Mode: cors';
	$headers[] = 'Sec-Fetch-Site: cross-site';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36';
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
    $parse = parse_url($urlvideo);
    $genada = json_decode($response,true);
    "[debugger] host : ".$parse['host'].PHP_EOL;
    if(!isset($genada['url']) && $parse['host'] == 'www.instagram.com'){
        echo "[debugger] Downloading using api.sssgram.com \n";
        $responsesdsd = json_decode(igDownload1($urlvideo),true);
        if(isset($responsesdsd['result']['insBos'][0]['url'])){
            $response = array();
            $response['url'] = $responsesdsd['result']['insBos'][0]['url'];
            $response = json_encode($response);
            echo "[debugger] file url ".$responsesdsd['result']['insBos'][0]['url']." \n";
        }else{
            echo "[debugger] file url not found \n";
        }
    }
    return $response;
}
function getYTMusic($urlvideo){
	$uri = cobaltserv();
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
    if(file_exists($url)){
        $fileContent = file_get_contents($url);
        file_put_contents($file, $fileContent);
        return true;
    }else{
        $parse = parse_url($url);
        $headers = array();
        $headers[] = 'Accept-Encoding: gzip, deflate';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        $headers[] = 'Origin: https://'.$parse['host'];
        $headers[] = 'Referer: https://'.$parse['host'];
        $headers[] = 'Sec-Ch-Ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"';
        $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
        $headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Site: cross-site';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        $fileContent = curl_exec($ch);
        if ($fileContent === false) {
            return false;
        }else{
            file_put_contents($file, $fileContent);
            return true;
        }
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

To start using the bot you must register, please type /register [server_key]

Author : https://www.facebook.com/arief.koto
Developer : https://arizu.id/";
return $pesan;
}
function helpMessage(){
$pesan = "Please read the usage instructions at https://arizu.id/blog/video-master-bot-usage-guide/";
    return $pesan;
}