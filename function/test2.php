<?php

// Informasi autentikasi
$app_id = '404975825327899';
$app_secret = '8b0f15166c80591f5684947c7aed18d1';
$access_token = 'EAAFauz9RYLkBO3gkNhiWWViWuMX95h3brrCKj20widc7XDGgT50JH6PR0ruljkmh5rPEzK1XEWHMpqXuOo33oMpaD0KOMHBpo3TFt6luiVA0G8kZC1zlNSyspFDR03FfWidQiIau4P9lpdndjGDMF4hHheAEX3mficBmkec1nfFfVkyJgIkfMj4bZAIQbU26AMjpfrnXXflkZCdTwhpQqBkL03v0qEZC3D0j8BoZD';

// ID Halaman Facebook Anda
$page_id = '112445415286581';

// Path ke video yang ingin Anda unggah
$video_path = '../files/video/videos_6423_1706580174.mp4';

// Pesan yang ingin Anda tambahkan ke posting
$message = 'Serem ya guys';

// URL endpoint untuk mengunggah video
$url = "https://graph.facebook.com/v18.0/{$page_id}/videos";

// Parameter yang diperlukan untuk mengunggah video
$params = array(
    'access_token' => $access_token,
    'description' => $message,
    'source' => new CURLFile($video_path)
);

// Inisialisasi cURL
$ch = curl_init();

// Set opsi cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi cURL dan dapatkan respons
$response = curl_exec($ch);
echo $response.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL;
// Tutup koneksi cURL
curl_close($ch);

// Proses respons
$result = json_decode($response, true);

// Cek apakah video berhasil diunggah
if (isset($result['id'])) {
    echo 'Video berhasil diunggah dengan ID: ' . $result['id'];
} else
if (isset($result['error'])) {
    echo $result['error']['message'];
}else{
    echo 'Gagal mengunggah video.';
}

?>
