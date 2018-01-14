<?php
session_start();
$url = 'https://slack.com/api/oauth.access';
$data = array('client_id' => '155127176102.293670961635', 'client_secret' => '27321abc0621b516a63e0bbaf80d390a', 'code' => $_GET['code']);

// access OAuth
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$result = json_decode($result, TRUE);

if (isset($_GET['error'])) {
    echo("<pre>");
    var_dump($_GET);
    echo("</pre>");
    // header('Location: ./error.php?code=4');
    exit();
}

// var_dump($result);
// handle the returned JSON object
if ($result['ok']) {
    $_SESSION['access_token'] = $result['access_token'];
    $_SESSION['user_name'] = $result['user']['name'];
    $_SESSION['user_id'] = $result['user']['id'];
    $_SESSION['team_id'] = $result['team']['id'];

    $file = "./../xmls/users.xml";
    $database = new Database($file);

    // add a new offer
    $user = $database->putIfAbsent("user", "id", $_SESSION['user_id']);
    $user->addAttribute("name", $_SESSION['user_name']);
    $user->addChild("requestlist");
    $user->addChild("receivedlist");
    $user->addChild("notification");

    $database->saveDatabase();

    header('Location: ./../index.php');
    exit();
} else {
    echo("<pre>");
    var_dump($result);
    echo("</pre>");
    // header('Location: ./error.php?code=5');
    exit();
}
?>