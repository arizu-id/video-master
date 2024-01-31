<?php
$name = $isiPerintah[0];
$video = $isiPerintah[1];
$caption = $isiPerintah[2];
if(!$name){
    $respon = "Please insert your session name";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!$video){
    $respon = "Please insert your video file";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!$caption){
    $respon = "Please insert your video caption";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("data/fb_page/$name.txt")){
    $respon = "session name not found, try send me /fbapp_pageall";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(!file_exists("files/video/$video")){
    $respon = "video not found, try send me /storage";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else{
    if(!file_exists('facebook_app.ini')){
        $respon = "Failed to read configuration file, try add configuration /fbapp_set [app_id] [app_secret]";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }else{
        $datafbapp = json_decode(file_get_contents('facebook_app.ini'),true);
        if(!$datafbapp['app_id']){
            $respon = "Your facebook app_id not set, try add configuration /fbapp_set [app_id] [app_secret]";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }else
        if(!$datafbapp['app_secret']){
            $respon = "Your facebook app_secret not set, try add configuration /fbapp_set [app_id] [app_secret]";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }else{
            $session_data = json_decode(file_get_contents("data/fb_page/$name.txt"),true);
            if(!$session_data['token']){
                $respon = "Your facebook session page_token is not set, try add configuration /fbapp_pageset [name] [token] [page_id]";
                sM("[REPLY] To : $chatId -> $respon");
                sendMessage($chatId, $messageId, $respon);
            }else
            if(!$session_data['page_id']){
                $respon = "Your facebook session page_id is not set, try add configuration /fbapp_pageset [name] [token] [page_id]";
                sM("[REPLY] To : $chatId -> $respon");
                sendMessage($chatId, $messageId, $respon);
            }else{
                $caption = str_replace('_',' ',$caption);
                $send = fbPagePost($datafbapp['app_id'],$datafbapp['app_secret'],$session_data['token'],$session_data['page_id'],"files/video/$video",$caption);
                $sendBaca = json_decode($send,true);
                if($sendBaca['hasil']=='sukses'){
$respon = "Post has been posted!
Post id : $sendBaca[vid_id]
Caption : $caption";
                    sM("[REPLY] To : $chatId -> $respon");
                    sendMessage($chatId, $messageId, $respon);
                }else{
                    $respon = "Failed to post video, $sendBaca[pesan]";
                    sM("[REPLY] To : $chatId -> $respon");
                    sendMessage($chatId, $messageId, $respon);
                }
            }
        }
    }
}