<?php
$filepreset = $isiPerintah[0];
$filepresettxt = "$filepreset.txt";
if(file_exists("files/prompt/$filepresettxt")){
    $presetdata = file_get_contents("files/prompt/$filepresettxt");
    for($kk=1;$kk<=10;$kk++){
                $presetdata = str_replace("[INPUT_$kk]",$isiPerintah[$kk],$presetdata);
                sM("[!] Change [INPUT_$kk] to $isiPerintah[$kk]");        
    }
        $commandMatches = detectCommand($presetdata);
        $commandArguments = isset($commandMatches[3]) ? $commandMatches[3] : '';	
        $commandName = $commandMatches[0];
        $commandName2 = explode(' ',$commandName);
        $commandName3 = explode('/',$commandName2[0]);
        $commandName = $commandName3[1];				
        $isiPerintah = explode(' ',$commandArguments);
        //echo $commandArguments;
    if(file_exists("command/$commandName.php")){
            include "command/$commandName.php";
        }else{
            $respon = "Command not found to execute $commandName from preset, try typing /help or view your preset /preset-all";
            sM("[REPLY] To : $chatId -> $respon");
            sendMessage($chatId, $messageId, $respon);
    }
}else{
    $respon = "preset not found";
    sM("[REPLY] To : $chatId -> $respon");
    sendMessage($chatId, $messageId, $respon);
}
?>