<?php
include ("../config_key.php");

$api_key = api_key();
$api_sign = api_sign();

$user_id = $_POST['user_id'];
$store_id = $_POST['store_id'];
$coupon_id = $_POST['coupon_id'];
$real_name = $_POST['real_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$identity_card = $_POST['identity_card'];

$ch = curl_init(); // 初始化

/* 駿騰登入測試 */
$url = $this_urladdr . "api/GetPrize";

$post_data = [
    "user_id" => $user_id,"store_id" => $store_id,"coupon_id" => $coupon_id,"real_name" => $real_name,"phone" => $phone,"email" => $email,"identity_card" => $identity_card,"api_key" => $api_key,"api_sign" => $api_sign
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