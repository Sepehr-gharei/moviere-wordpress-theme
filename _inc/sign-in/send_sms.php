<?php 

function wp_mr_send_sms($args,$to,$bodyId){
    $username = '989160721720';
    $password = 'ed63d260-e2d0-4cee-a925-c1832345b7cd';
    $data = array('username' => $username , 'password' => $password,'text' => "$args",'to' =>$to,"bodyId"=>$bodyId);
    $post_data = http_build_query($data);
    $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber');
    curl_setopt($handle, CURLOPT_HTTPHEADER, array(
        'content-type' => 'application/x-www-form-urlencoded'
    ));
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($handle);
   
}