<?php
session_start();
include("functions/c_main.php");

if(isset($_SESSION["username"]) && isset($_SESSION["access"]) && $_SESSION["access"] == md5(c_security::openssl_crypto(c_security::get_ip()))){
    
}
else{
    header("Location: login.php"); exit();
}

?>
<!DOCTYPE html>
<html style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Prodigal | Home</title>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" href="css/new-styles.css">
</head>

<body style="height: 100%;">
    <div class="login-dark" style="background-image: url(&quot;images/background.jpg&quot;);height: 100%;background-repeat: no-repeat;background-position: center;">
        <form class="home-screen" style="max-width: 50%;">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration" style="padding-top: 0px;padding-bottom: 30px;"><img class="logo-dash" src="images/logo.png" style="width: auto;">
                <h4 class="text-white" style="font-weight: bold;">Prodigal Cheats</h4>
            </div>
            <div class="form-group text-center"><a href="discord/" class="btn btn-dark page-button glow-on-hover" type="submit" style="width:40%; margin-left:5%; margin-right:5%;">Discord</a><a href="https://sellix.io/prodigalcheats" class="btn btn-dark page-button glow-on-hover" type="submit" style="width:40%; margin-left:5%; margin-right:5%;">Shop</a></div>
            <div
                class="form-group text-center"><a href="activate.php" class="btn btn-dark page-button glow-on-hover" type="submit" style="width:40%; margin-left:5%; margin-right:5%;">Redeem Key</a><a href="changepass.php" class="btn btn-dark page-button glow-on-hover" type="submit" style="width:40%; margin-left:5%; margin-right:5%;">Change Password</a></div>
    <div
        class="form-group text-center"><a href="admin/index.php" class="btn btn-dark page-button glow-on-hover" type="submit" style="width:40%; margin-left:5%; margin-right:5%;">Admin Panel</a></div>
        </form>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
</body>

</html>