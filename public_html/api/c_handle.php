<?php
include ("../functions/c_main.php");

if(isset($_GET["m"])) {
    if (c_api_login(c_security::decrypt($_POST["username"]), c_security::decrypt($_POST["password"]), c_security::decrypt($_POST["hwid"]))) {
        echo c_security::encrypt(c_response::$c_api_login);
        exit();
    } else {
        echo c_security::encrypt(c_response::$c_api_login);
        exit();
    }
}
