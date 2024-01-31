<?php
$name = $isiPerintah[0];
$token = $isiPerintah[1];
$page_id = $isiPerintah[2];
if(!$name){
    $respon = "Please insert your session name";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!$token){
    $respon = "Please insert your page token, you can use https://developers.facebook.com/tools/explorer/ to generate";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!$page_id){
    $respon = "Please insert your page id";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(file_exists("data/fb_page/$name.txt")){
    $respon = "Session name already set, try with other name or delete first";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    $folder = "data/fb_page/";
    $bekano = array();
    $bekano['token'] =  $token;
    $bekano['page_id'] =  $page_id;
    $dataxx = json_encode($bekano);
    file_put_contents("$folder$name.txt",$dataxx);
    if(file_exists("$folder$name.txt")){
        $respon = "Session saved as $name";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }else{
        $respon = "failed to save session data";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }
}
?>