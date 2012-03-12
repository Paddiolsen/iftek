<?php

/**
 * Opdaterings job.
 */

print_r($_SERVER);
die();
require_once("conf/config.php");
require_once("models/users.php");
require_once("post.php");

$date = time();
$tomorrow = $date + 24 * 3600;

$user = getUser($_GET['user_id']);
$access_token = $_GET['access_token'];

if($access_token != $user->access_token){
    echo('Forkert access token for det bruger id!');
    die();
}

$activities = lectioGetActivities($user->lectio_id, $date);

if(count($activities) > 0){
    $txt = '';
    foreach($activities as $activity){
        $txt = $txt . $activity['class'] . ' ' . $activity['time'] . ' ' . $activity['homework'] . '.';
    }
    
    $response = json_decode(fbPost($user, $txt));
    
    if(array_key_exists('error', $response)){
        error_log($response->error);
    }
}
?>