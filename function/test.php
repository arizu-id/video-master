<?php

// Token akses untuk halaman Facebook Anda
$page_access_token = 'EAAFauz9RYLkBO5341BDTYIzLtFDUG8v5TRMk3M2ry5KkTUsfID4h1Sh6CXRj8RBIAgudN9bpSgokqNwBVoZBORVy9e4FUGjNfO3tUS9X1ok5r5Kb3SO3IQ1UJSOgPFs0N5U2JFLLuX5KcV83ZCj2q4wnlKvLF58HwYOW9bNjZBK267uZBOnQg9wGHS3QwMhiHoPKm7BojKRbaRcZD';

// ID halaman Facebook Anda
$page_id = '112445415286581';

// Path ke video yang ingin Anda unggah
$video_path = '../files/video/videos_6423_1706580174.mp4';

// Pesan yang ingin Anda tambahkan ke posting
$message = 'Jadi ngeri ya guys';

// URL endpoint untuk mengunggah video
$url = "https://graph-video.facebook.com/{$page_id}/videos";
//$url = "https://graph.facebook.com/v18.0/$page_id/videos";
// Parameter yang diperlukan untuk mengunggah video
$params = array(
    'title' => 'Kok Bisa Ada Ada Disitu Guys?',
    'description' => $message,
    'access_token' => $page_access_token,
    'source' => '@' . realpath($video_path)
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
