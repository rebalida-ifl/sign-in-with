<?php

namespace App;

error_reporting(E_ALL & ~E_DEPRECATED); 


require_once '../src/Database.php';
require_once '../src/User.php';
require_once '../vendor/autoload.php';

Use PDO;

session_start();

$database = new Database();
$db = $database->connect();

$user = new User($db);


$client = new \Google\Client();
$client->setClientId('128228478620-o2d294sberho44jpetq6laog0ajgk2v8.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/sign-in-with/public/callback.php');
$client->addScope('email');
$client->addScope('profile'); 

$fb = new \Facebook\Facebook([
    'app_id' => '513392914943900',
    'app_secret' => 'c6e7da7e7ee58ffe62a19cdd8cff67a7',
    'default_graph_version' => 'v10.0', 
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/sign-in-with/public/fb-callback.php', $permissions);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if($user->login()){
            $_SESSION['id'] = $user->id;
            $_SESSION['username'] = $user->username;
    
            header('Location: index.php');
        }else{
            echo 'Failed';
        }
    }


?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <header>
            
        </header>

        <main>
            <section class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="container">
                    <div class="text-center">
                        <h1 class="fw-bold">Sign In</h1>
                        <p>Don't have an account? <a href="register.php" class="text-center">Sign Up</a> </p>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 d-flex align-items-center justify-content-center">
                        <form class="w-75" action="login.php" method="POST">
                            <div class="mb-4">
                                <input type="email" class="form-control form-control-lg" id="email" placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <input type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-dark btn-lg border border-black rounded-0 w-100">Login</button>
                        </form>
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-center">

                            <div class="d-flex flex-column"> 
                               
                            <a href="<?= $client->createAuthUrl(); ?>"class="btn btn-outline-dark btn-lg border border-black rounded-0 my-2"><i class="bi bi-google text-danger pe-3 h5"></i>Sign In With Google</a>
                            <a href="<?= htmlspecialchars($loginUrl); ?>"class="btn btn-outline-dark btn-lg border border-black rounded-0 my-2"><i class="bi bi-facebook text-danger px-2 h5"></i>Sign In With Facebook</a>    

                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
        </main>
        
        <footer>
            
        </footer>
        
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
