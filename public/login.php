<?php

namespace App;

require_once '../src/Database.php';
require_once '../src/User.php';

Use PDO;

session_start();

$database = new Database();
$db = $database->connect();

$user = new User($db);

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

        <!-- <style>
            .gradient {
                background-image: linear-gradient(
                    70deg,
                    hsl(294deg 84% 27%) 0%,
                    hsl(304deg 100% 26%) 8%,
                    hsl(312deg 100% 30%) 17%,
                    hsl(318deg 100% 33%) 25%,
                    hsl(324deg 100% 36%) 33%,
                    hsl(329deg 100% 39%) 42%,
                    hsl(333deg 100% 41%) 50%,
                    hsl(337deg 100% 44%) 58%,
                    hsl(341deg 100% 46%) 67%,
                    hsl(345deg 100% 47%) 75%,
                    hsl(349deg 100% 48%) 83%,
                    hsl(353deg 100% 49%) 92%,
                    hsl(0deg 100% 50%) 100%
                );
            }
        </style> -->
    </head>

    <body>
        <header>
            
        </header>

        <main class="d-flex align-items-center justify-content-center vh-100">
            <div class="container py-5 rounded bg-dark">
                <div class="row text-white">
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <h1>Login</h1>
                    </div>

                    <div class="col-6">
                        <form action="login.php" method="POST" class="mx-auto" style="max-width: 300px;">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                            <a href="register.php" class="text-center">Sign Up</a> 
                        </form>
                    </div>
                    
                </div>
            </div>
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
