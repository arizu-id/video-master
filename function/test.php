<?php
$app = json_decode(file_get_contents("../facebook_app.ini"),true);
$app_id = $app['app_id'];
$app_secret = $app['app_secret'];

$url = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&client_secret=$app_secret&grant_type=client_credentials";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
echo $response.PHP_EOL.PHP_EOL;
$bkt = json_decode($response,true);


$video_path = "../files/video/videos5029_1706749410.mp4";
$params = array(
    'access_token' => $bkt['access_token'],
    'message' => "hai semua",
    'image_url' => $video_path
);
$url2 = "https://graph.facebook.com/v19.0/{61790410569}/media";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
echo $response = curl_exec($ch2);
?>