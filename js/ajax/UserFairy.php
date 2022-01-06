<?php

include ("../config_key.php");



$api_key = api_key();

$api_sign = api_sign();



$ch = curl_init(); // 初始化

$user_id = $_POST['user_id'];



/* 駿騰登入測試 */

$url = $this_urladdr . "api/UserFairy";



$post_data = [

    "user_id" => $user_id,"api_key" => $api_key,"api_sign" => $api_sign

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

if($output) {

    // echo $output;

    $tmp = json_decode($output, true)['data'];

    if(is_array($tmp)) {

        $tmp = array_values($tmp);

        echo trim(json_encode($tmp, JSON_UNESCAPED_UNICODE));

        

    }else {

        echo '[]';

    }

}else {

    echo '[]';

}



curl_close($ch);

