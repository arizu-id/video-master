<?php
$app_id = $isiPerintah[0];
$app_secret = $isiPerintah[1];
if(!$app_id){
    $respon = "Please insert your APP_ID, you can create facebook application at https://developers.facebook.com/apps/";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!$app_secret){
    $respon = "Please insert your app_secret, you can create facebook application at https://developers.facebook.com/apps/";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    $bekano = array();
    $bekano['app_id'] =  $app_id;
    $bekano['app_secret'] =  $app_secret;
    $dataxx = json_encode($bekano);
    file_put_contents('facebook_app.ini',$dataxx);

    $respon = "APP Configuration has been set, run /fbapp_detail to see your app detail";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}
?>