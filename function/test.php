<?php
include "func.php";
$message = "/preset-sv PWFLIP-WAW /watermarkflipchangeaudio [INPUT_1] 0.4 250 2 2 pwlogo.png waw.mp3 0.3";
$message = str_replace('  ',' ',$message);
$commandMatches = detectCommand($message);
$commandName = $commandMatches[1];
$commandArguments = isset($commandMatches[3]) ? $commandMatches[3] : '';
$pixah = explode(' /',$commandArguments);
$preset_name = $pixah[0];
$prompt = '/'.$pixah[1];
echo $prompt;