![Screenshot](files/vdmaster.jpg)
# System Requirements
- Requires PHP7 or more<br/>
install "yum -y install php-cli php php-curl" or "sudo apt install php-cli php php-curl"<br/><br/>
- FFMpeg binaries<br/>
If you want to use the auto matermark & flip mirror video feature, you need binaries from FFMpeg

# Install FFMpeg binaries in Linux
- git clone https://git.ffmpeg.org/ffmpeg.git ffmpeg
- cd ffmpeg
- ./configure
- make
- make install

# Install FFMpeg binaries in Windows
1. download https://www.gyan.dev/ffmpeg/builds/ffmpeg-git-essentials.7z
2. extract file & rename folder name
3. add to environment path -> YOUR_FFMPEG_FOLDER_LOCATION/bin/

# How to Install Downloader
- git clone https://github.com/arizu-id/video-master.git videomaster<br/>
- cd videomaster<br/>
- php run.php<br/>

# Command List
![Screenshot](files/test.jpg)
- /download [url]
- /flip [url]
### Watermark Module
- /watermark [url_video] [opacity] [size] [position_y] [position_x] [images]
- /watermarkaddaudio [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
- /watermarkaddaudioborder [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume] [borderColor] [borderSize]
- /watermarkflip [url_video] [opacity] [size] [position_y] [position_x] [images]
- /watermarkflipaddaudio [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume]
- /watermarkflipaddaudioborder [url_video] [opacity] [size] [position_y] [position_x] [images] [audio] [volume] [borderColor] [borderSize]
#### Example
- /watermarkaddaudio https://www.instagram.com/reel/C2PcFZurlzP/?igsh=ZTViajMzamR1M25l 0.75 350 8 2 pwlogo.png waw.mp3 0.3
- /watermarkaddaudioborder https://www.instagram.com/reel/C2PcFZurlzP/?igsh=ZTViajMzamR1M25l 0.75 350 8 2 pwlogo.png waw.mp3 0.3 green 25
#### List Video Saved on Server
- /storage
- /storageclean
### List File Thumbnail on Server
- /thumbnaildelete
- /thumbnaillist
- /thumbnailsave [url] [filename]
- /thumbnailsend [filename]
### List File Audio on Server
- /audiodelete [filename]
- /audiolist
- /audiosave [url] [filename]
- /audiosend [filename]
- /audioyt [url] [filename]
