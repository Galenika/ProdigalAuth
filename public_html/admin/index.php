<?php
session_start();
include("../functions/c_main.php");

if(isset($_SESSION["username"]) && isset($_SESSION["access"]) && $_SESSION["access"] == md5(c_security::openssl_crypto(c_security::get_ip()))){
    $query = $c_con->query("SELECT * FROM c_data WHERE c_username='" . c_security::anti_sql_string(c_security::openssl_decrypto($_SESSION["username"])) . "'");
    if($query->num_rows != 0){
        while($c_row = $query->fetch_assoc()){
            if ($c_row['c_admin'] == '1') {}
            else{
                echo "ur not an admin"; exit();
            }
        }
    }
    else{
        echo "invalid user"; exit();
    }
}
else{
    header("Location: ..\login.php"); exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tokens"])) {
    for ($value = 0; $value < $_POST["tokensammount"]; $value++) {
        $c_con->query("INSERT INTO c_keys(c_key, c_days, c_used) VALUES ('".strtoupper(c_security::random_string(22))."', '".c_security::anti_sql_string($_POST["daysammount"])."', '0')");
        header("Refresh:0");
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hwidreset"])){
    $c_con->query("UPDATE c_data SET c_hwid=NULL WHERE c_username='".c_security::anti_sql_string($_POST["resetuser"])."'");
    header("Refresh:0");
}
?>
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
    hello admin, to gen tokens complete this form : <br>
    <label>Tokens Ammount :</label>
    <input type="text" name="tokensammount"> <br>
    <label>Days Ammount :</label>
    <input type="text" name="daysammount"> <br>
    <button name="tokens">gen</button>
</form>
<br>
<form action="" method="post">
    to hwid reset an user you do <br>
    <label>Username :</label>
    <input type="text" name="resetuser"> <br>
    <button name="hwidreset">reset</button>
</form>

<br> <br>
all the keys : <br>
<?php
$result = $c_con->query("SELECT * FROM c_keys");

echo "<table>";
while($c_row = $result->fetch_assoc()){
    echo $c_row["c_key"] . "|" . $c_row["c_days"] . "|" . $c_row["c_used"]; echo "<br>";
}
echo "</table>";
?>
</body>
</html>



