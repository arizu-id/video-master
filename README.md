<h2 align="center">We present a tool with very useful functions to help your work</h2>
Video Master is a tool that helps you speed up the time for editing a video, generally if you edit a video from collecting materials or assets to the rendering stage it takes 5-10 minutes at the fastest. However, with this tool you only need 2-5 minutes (depending on your server specifications).

![Screenshot](files/vdmaster.jpg)
# Recommended Specifications
- 4 Core vCPU
- 8 GB RAM
# System Requirements
- Requires PHP7 or more<br/>
install in centOS / Almalinux
```
yum -y install php-cli php php-curl
```
install in Debian / Ubuntu
```
sudo apt install php-cli php php-curl
```
- FFMpeg binaries<br/>
If you want to use the auto matermark & flip mirror video feature, you need binaries from FFMpeg

# Install FFMpeg binaries in Linux
```
git clone https://git.ffmpeg.org/ffmpeg.git ffmpeg && cd ffmpeg
./configure
make
make install
```

# Install FFMpeg binaries in Windows
```
download https://www.gyan.dev/ffmpeg/builds/ffmpeg-git-essentials.7z
extract file & rename folder name
add to environment path -> YOUR_FFMPEG_FOLDER_LOCATION/bin/
```

# How to Install Video Master
```
git clone https://github.com/arizu-id/video-master.git videomaster<br/>
cd videomaster<br/>
php run.php<br/>
```

# Command List
![Screenshot](files/test.jpg)
```
/download [url]
/flip [url]
```
### Auto Editing With Watermark Module
```
/watermark [url_video] [opacity] [size] [position_y] [position_x] [images]
/watermarkaddaudio [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
/watermarkaddaudioborder [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume] [borderColor] [borderSize]
/watermarkchangeaudio [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
/watermarkflip [url_video] [opacity] [size] [position_y] [position_x] [images]
/watermarkflipaddaudio [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
/watermarkflipaddaudioborder [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume] [borderColor] [borderSize]
/watermarkflipchangeaudio [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
```
#### Example
```
/watermarkaddaudio https://www.instagram.com/reel/C2PcFZurlzP/?igsh=ZTViajMzamR1M25l 0.75 350 8 2 pwlogo.png waw.mp3 0.3
/watermarkaddaudioborder https://www.instagram.com/reel/C2PcFZurlzP/?igsh=ZTViajMzamR1M25l 0.75 350 8 2 pwlogo.png waw.mp3 0.3 green 25
```
#### List Video Saved on Server
```
/storage
/storageclean
```
### List File Thumbnail on Server
```
/thumbnaildelete
/thumbnaillist
/thumbnailsave [url] [filename]
/thumbnailsend [filename]
```
### List File Audio on Server
```
/audiodelete [filename]
/audiolist
/audiosave [url] [filename]
/audiosend [filename]
/audioyt [url] [filename]
```
