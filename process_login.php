<?php
$url = 'https://slack.com/api/oauth.access';
$data = array('client_id' => '293788574964.293935676385', 'client_secret' => '6c57ee01b0601eca4c39633d27277492', 'code' => $_GET['code']);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
$result = json_decode($context);
print("1" . $result);
print("2" . $result['ok']);
print("3" . $result.ok);
// var_dump($result);
if ($result['ok']) {

}
?>