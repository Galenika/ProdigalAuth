<?php
include ("../functions/c_main.php");

//this was mostly made for cheetos
//i was going to do an function, but its not needed and stuff, this should work fine

if(isset($_POST["t"])){
    global $c_con; //who dont love globals :)

    $res = $c_con->query("SELECT * FROM c_tokens WHERE c_token='".c_security::anti_sql_string(c_security::decrypt($_POST["t"]))."'");
    if($res->num_rows != 0){
        while($c_row = $res->fetch_assoc()){
            if($c_row["c_expires"] > time()){
                c_response::$c_api_download = "success";
                /* here you do whatever you want to do when your session is not expired */
                header('Content-Type: application/dll'); //bug fix

                require __DIR__ . "\\example.dll"; //dll path
            }
            else{
                c_response::$c_api_download = "token_expired"; exit();
                //im fine with no errors lmfao
            }
        }
    }
    else{
        c_response::$c_api_download = "unexistent_token"; exit();
    }
}
