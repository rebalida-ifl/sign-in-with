<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
$client = new \Google\Client();
$client->setClientId('128228478620-o2d294sberho44jpetq6laog0ajgk2v8.apps.googleusercontent.com');
// $client->setClientSecret('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');
$client->setRedirectUri('http://localhost/sign-in-with/public/callback.php');
$client->addScope('email');
$client->addScope('profile'); 

if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    $client->setAccessToken($token['access_token']);

    $google_oauth = new \Google\Service\Oauth2($client);
    $userInfo = $google_oauth->userinfo->get();

    $email = $userInfo->email;
    $username = $userInfo->name;

    $_SESSION['id'] = $email;
    $_SESSION['username'] = $username;


    header('Location: index.php');
    exit();
}

header('Location: login.php');
exit();
