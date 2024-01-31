<?php
function fbPagePost($app_id,$app_secret,$access_token,$page_id,$video_path,$message){

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
    //echo $response.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL;
    // Tutup koneksi cURL
    curl_close($ch);

    // Proses respons
    $result = json_decode($response, true);

    // Cek apakah video berhasil diunggah
    if (isset($result['id'])) {
        $respon = array("hasil"=>"sukses","vid_id"=>$result['id']);
    } else
    if (isset($result['error'])) {
        $pesandia = $result['error']['message'];
        $respon = array("hasil"=>"gagal","pesan"=>$pesandia);
    }else{
        $respon = array("hasil"=>"gagal","pesan"=>$response);
    }
    return json_encode($respon);
}
?>