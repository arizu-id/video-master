<?php
$commandArguments;
$pixah2 = explode('/',$message);
$pixah3 = explode(' ',$pixah2[1]);
$preset_name = trim($pixah3[1]);
$prompt = '/'.$pixah2[2];
$cek_dulu = detectCommand($prompt);
$commandNames = $cek_dulu[1];
if(!$preset_name){
    $respon = "Please enter preset name!";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage($chatId, $messageId, $respon);
}else
if(!$prompt){
    $respon = "Please enter prompt for preset!";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage($chatId, $messageId, $respon);
}else
if(file_exists("command/$commandName.php")){
    if(file_exists("files/prompt/$preset_name.txt")){        
        $respon = "Prompt name $preset_name already added, plase try another name!";
        sM("[REPLY] To : $chatId -> $respon");
        sendMessage($chatId, $messageId, $respon);
    }else{
        if(file_put_contents("files/prompt/$preset_name.txt",$prompt)){
            $respon = "Preset has been saved as $preset_name";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }else{
            $respon = "Failed to save preset";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
        }
    }
}else{
    $respon = "Prompt command not found, please check our command from /help";
	sM("[REPLY] To : $chatId -> $respon");
	sendMessage($chatId, $messageId, $respon);
}
?>