<?php
include("functions/c_main.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!isset($_GET["token"])) {
        if (c_forgot_password($_POST["email"])) {
            echo "well done";
        } else {
            echo c_response::$c_reset;
            exit();
        }
    }
    else{
        if (c_new_password($_GET["token"], $_POST["new_password"])) {
            echo "well done";
        } else {
            echo c_response::$c_reset;
            exit();
        }
    }
} ?>
<?php
if(isset($_GET["token"])){ ?>
    <form action="" method="post">
    <label>put your pass :</label>
    <br>
    <input type="text" name="new_password">
    <button>send</button>
    </form>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FODA SI</title>
</head>
<body>
<form action="" method="post">
    <label>Email</label>
    <br>
    <input type="text" name="email">
    <br>
    <button>send</button>
</form>
</body>
</html>
