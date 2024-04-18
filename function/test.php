<?php
function cobaltserv(){
    return "https://us2-co.wuk.sh/api/json";
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
echo getVideo("https://www.tiktok.com/@4ykarll0k/video/7356229379057257736?is_from_webapp=1&sender_device=pc");
