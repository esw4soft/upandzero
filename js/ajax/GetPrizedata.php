<?php
include ("../config_key.php");

$api_key = api_key();
$api_sign = api_sign();

$data_id = $_POST['data_id'];


$ch = curl_init(); // 初始化

/* 駿騰登入測試 */
$url = $this_urladdr . "api/GetPrizedata";

$post_data = [
    "data_id" => $data_id,"api_key" => $api_key,"api_sign" => $api_sign
];

$post_data = json_encode($post_data);

// 设置选项，包括url
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //這個是重點,規避ssl的證書檢查。
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'admin:admin');

$output = curl_exec($ch);

// echo $output;
$outputArr = json_decode($output, true);
if (isset($outputArr['data'])) {
    echo trim(json_encode(json_decode($output, true)['data'], JSON_UNESCAPED_UNICODE));
} else {
    echo '[]';
}

curl_close($ch);