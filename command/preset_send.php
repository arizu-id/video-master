<?php
echo $filepreset = $commandArguments;
$filepresettxt = "$filepreset.txt";
if(!$filepreset){
    $respon = "please insert preset name";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}else
if(file_exists("files/prompt/$filepresettxt")){
    $presetdata = file_get_contents("files/prompt/$filepresettxt");
    sM("[REPLY] To : $chatId -> (preset data)");
    sendMessage2($chatId, $messageId, $presetdata);
}else{
    $respon = "preset file $filepreset not found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}
?>