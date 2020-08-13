<?php
session_start();
include("functions/c_main.php"); 

if(isset($_SESSION["username"]) && isset($_SESSION["access"]) && $_SESSION["access"] == md5(c_security::openssl_crypto(c_security::get_ip()))){
    header("Location: dashboard.php"); exit();
}
else{
    
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(c_login($_POST["username"], $_POST["password"])){
        $_SESSION["username"] = c_security::openssl_crypto(strip_tags($_POST["username"])); //thanks Pured
        $_SESSION["access"] = md5(c_security::openssl_crypto(c_security::get_ip()));

        header("Location: dashboard.php");
    }
    else{
        echo c_response::$c_login;
    }
}
?>

<!DOCTYPE html>
<html style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Prodigal | Log-In</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/new-styles.css">
</head>

<body style="height: 100%;">
    <div class="login-dark" style="background-image: url(&quot;images/background.jpg&quot;);height: 100%;font-size: 50px;">
        <form method="post" style="max-width: 400px;">
            <h2 class="sr-only">Prodigal | Log-In</h2>
            <div class="illustration" style="padding-top: 0px;padding-bottom: 30px;"><img class="logo-login" src="images/logo.png" style="width: auto;">
                <h4 class="text-center text-white" style="font-weight: bold;">Member Login</h4>
            </div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-dark btn-block page-button glow-on-hover" type="submit">Login</button>
            <a href="index.php" class="btn btn-dark btn-block page-button glow-on-hover" type="submit">Home</a></div><a class="forgot" href="forgotpass.php#" style="margin-bottom: 10px;">Forgot your Password?</a>
            <a
                class="forgot" href="register.php">Don't Have An Account?</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
