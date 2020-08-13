<?php 
include("functions/c_main.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["password"] == $_POST["repeat_pass"]) {
            if (c_register($_POST["username"], $_POST["email"], $_POST["password"])) {
                header("Location: login.php");
            } else{
                echo c_response::$c_register; exit();
            }
        }
        else{
            echo "repeated password is wrong"; exit();
        }
    }
?>


<!DOCTYPE html>
<html style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Prodigal | Register</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/new-styles.css">
</head>

<body style="height: 100%;">
    <div class="login-dark" style="background-image: url(&quot;images/background.jpg&quot;);height: 100%;font-size: 50px;">
        <form method="post" style="max-width: 400px;">
            <h2 class="sr-only">Prodigal | Register</h2>
            <div class="illustration" style="padding-top: 0px;padding-bottom: 30px;"><img class="logo-login" src="images/logo.png" style="width: auto;">
                <h4 class="text-center text-white" style="font-weight: bold;">Register User</h4>
            </div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
            <div class="form-group"><input class="form-control" type="text" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><input class="form-control" type="password" name="repeat_pass" placeholder="Repeat password"></div>
            <div class="form-group"><button class="btn btn-dark btn-block page-button glow-on-hover" type="submit">Register</button>
            <a href="index.php" class="btn btn-dark btn-block page-button glow-on-hover" type="submit">Home</a></div>
            <a
                class="forgot" href="login.php">Login</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
