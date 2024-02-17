<?php
$namass = $isiPerintah[0];
$filecookiefileid = $pesan['message']['document']['file_id'];
$getfilecookie = json_decode(getFile($filecookiefileid),true);
if(file_exists("data/fb_page/$namass.txt")){
    $respon = "Cookie name for $namass already added, show all /fp";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage2($chatId, $messageId, $respon);
}else{
    if(downloadAndSaveFile($getfilecookie['result']['file_path'],"data/fb_page/$namass.txt")){
        $respon = "Cookie saved as $namass, show all /fp";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage2($chatId, $messageId, $respon);
    }else{
        $respon = "Failed to save your cookies";
	    sM("[REPLY] To : $chatId -> $respon");
	    sendMessage2($chatId, $messageId, $respon);
    }
}
?>