<?php
$respon = "Auto upload to Facebook reels, code by ahda (https://github.com/wahdalo)

1. download & install chrome extension https://chromewebstore.google.com/detail/%E3%82%AF%E3%83%83%E3%82%AD%E3%83%BCjson%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E5%87%BA%E5%8A%9B-for-puppet/nmckokihipjgplolmcmjakknndddifde

2. Open the website facebook.com

3. export cookies

4. upload the file to bot using the caption /fp_save [name], for example /fp_save myquotesdaily

5. For captions, use underscores as pronouns for spaces, for example #viral_#unique_#quotes

6. upload a video with the command /fp_u [video] [cookies] [caption], for example /fp_u video.mp4 myquotesdaily #viral_#unik_#quotes";
sM("[REPLY] To : $chatId -> $respon");
sendMessage2($chatId, $messageId, $respon);

?>