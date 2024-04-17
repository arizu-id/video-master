<?php

function igDownload($url){
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
    echo $response = curl_exec($ch);
}
$url = 'http://google.com/dhasjkdas/sadsdds/sdda/sdads.html';
$parse = parse_url($url);
echo $parse['host'];
