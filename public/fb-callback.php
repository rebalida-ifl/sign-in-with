<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);


$fb = new \Facebook\Facebook([
    'app_id' => '513392914943900',
    'app_secret' => 'c6e7da7e7ee58ffe62a19cdd8cff67a7',
    'default_graph_version' => 'v10.0', 
]);

$helper = $fb->getRedirectLoginHelper();

try{

    $accessToken = $helper->getAccessToken();

   
}catch (Facebook\Exceptions\FacebookResponseException $e){
    echo 'Error: ' . $e->getMessage();
    exit();
    
}catch(Facebook\Exceptions\FacebookSDKException $e){
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit();
}

if(isset($accessToken)){
    $_SESSION['fb_access_token'] = (string) $accessToken;

    try{
        $response = $fb->get('/me?fields=id,name,email', $accessToken);
        $user = $response->getGraphUser();


        echo "<pre>";
    print_r($user);
    echo "</pre>";

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['name'];

        if (isset($user['email'])) {
            $_SESSION['email'] = $user['email'];
        } else {
            $_SESSION['email'] = 'Email not available';
            // Optional: Log this occurrence for review
            error_log("Email not available for user ID: " . $user['id']);
        }


        header('Location: index.php');
        exit();
    }catch(Facebook\Exceptions\FacebookResponseException $e){
        echo 'Error: ' . $e->getMessage();
        exit();
    }catch(Facebook\Exceptions\FacebookSDKException $e){
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit();
    }
}else{
    header('Location: login.php');
    exit();
}

