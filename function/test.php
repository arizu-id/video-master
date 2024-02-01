<?php
$baraa = shell_exec('tiktok-uploader -v ../files/video/videos2814_1706751114.mp4 -d "hai" -c ../data/tiktok_cookies/baju.txt');
if(strpos($baraa,"py test.py")){
    echo "a";
}else{
    echo "b";
}