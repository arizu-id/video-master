<?php
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
    if(!is_dir("render")){
        mkdir("render");
    }
    if(!file_exists("terbaru.txt")){
        file_put_contents("terbaru.txt","0  ");
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
function addBacksound($video,$audio,$volume,$output){
	if(file_exists("temps/$video")){
		echo shell_exec('ffmpeg -i temps/'.$video.' -i '.$audio.' -filter_complex "[1:0]volume='.$volume.'[a1];[0:a][a1]amix=inputs=2:duration=first" -map 0:v:0 -y temps/'.$output.'.mp4');
	}else{
		return false;
	}
}
function helpMessage(){
$pesan = "Auto Download & Editing Videos
/download [url]

Thumbnail on Server
/thumbnailsave [url] [filename]
/thumbnaillist
thumbnailsend [filename]

Audio on Server
/audiosave [url] [filename]
/audiolist
/audiosend [filename]
/audioyt [url] [filename]";
    return $pesan;
}