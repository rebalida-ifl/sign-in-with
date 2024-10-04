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
        <main>
            <section class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="container">
                    <div class="text-center">
                        <h1 class="fw-bold">Sign Up</h1>
                        <p>Already have an Account? <a href="login.php" class="text-center">Sign In</a> </p>
                    </div>

                    <div class="d-flex align-items-center justify-content-center">

                        <form class="w-50" action="register.php" method="POST">
                            <div class="mb-4">
                                <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" required>
                            </div>

                            <div class="mb-4">
                                <input type="username" name="username" class="form-control form-control-lg" placeholder="Username" required>
                            </div>

                            <div class="mb-4">
                                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-dark btn-lg border border-black rounded-0 w-100">Register</button>
                        </form>

                    </div>

                </div>
            </section>
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

