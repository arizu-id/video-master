<?php

/**
 * Creator    : mzcoder-hub
 * Created at : Juli 2024
 * Website    : https://mzn0.dev
 **/

function is_uploaded($video_name, $log_file) {
    if (!file_exists($log_file)) {
        return false;
    }
    $uploaded_videos = file($log_file, FILE_IGNORE_NEW_LINES);
    return in_array($video_name, $uploaded_videos);
}

function log_uploaded($video_name, $log_file) {
    file_put_contents($log_file, $video_name . PHP_EOL, FILE_APPEND);
}

function upload_videos($config) {
    require '../../../vendor/autoload.php';
    
    $instagram = \InstagramAPI\Instagram::withCredentials($config['username'], $config['password']);
    $instagram->login();

    $videos = array_filter(scandir($config['video_folder']), function($file) {
        return pathinfo($file, PATHINFO_EXTENSION) === 'mp4';
    });

    foreach ($videos as $video) {
        $video_path = $config['video_folder'] . '/' . $video;
        $caption = pathinfo($video, PATHINFO_FILENAME);
        
        if (!is_uploaded($video, $config['log_file'])) {
            try {
                $instagram->timeline->uploadVideo($video_path, ['caption' => $caption]);
                log_uploaded($video, $config['log_file']);
                echo "Uploaded {$video} successfully.\n";
            } catch (Exception $e) {
                echo "Failed to upload {$video}: {$e->getMessage()}\n";
            }
            
            sleep($config['delay']);
        } else {
            echo "{$video} has already been uploaded.\n";
        }
    }
}

$config = include '../../../config.php';
upload_videos($config);

?>
