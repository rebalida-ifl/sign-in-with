<?php

namespace App;

require_once '../src/Database.php';
require_once '../src/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user->email = $_POST['email'];
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if($user->emailExist()){
        echo 'Email Already Exists';
    }else{
        if($user->register()){ 
            echo 'Success';
        }else{
            echo 'Failed to register user';
        }
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Register</title>
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
        
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main class="d-flex align-items-center justify-content-center vh-100">
            <div class="container py-5 rounded bg-dark">
                <div class="row text-white">
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <h1>Register</h1>
                    </div>

                    <div class="col-6">
                        <form action="register.php" method="POST" class="mx-auto" style="max-width: 300px;">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="username" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                            <a href="login.php" class="text-center">Log In</a> 
                        </form>
                    </div>
                    
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
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

