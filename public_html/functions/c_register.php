<?php

include_once ("c_settings.php");
include_once ("c_security.php");
include_once ("c_response.php");

function c_register($c_username, $c_email, $c_password) {
    global $c_con; // ghetto asf(i dont like funcs!)

    if (!empty($c_username) && !empty($c_password) && !empty($c_email)) {
        if (!$c_con->query("SELECT * FROM c_data WHERE c_username='" . c_security::anti_sql_string($c_username) . "'")->num_rows > 0) {
            if(filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
                if (!$c_con->query("SELECT * FROM c_data WHERE c_email = '" . c_security::anti_sql_string($c_email) . "'")->num_rows > 0) {
                    $c_con->query("INSERT INTO c_data (c_username, c_email, c_password, c_ip) 
  			  VALUES ('" . c_security::anti_sql_string($c_username) . "', '" . c_security::anti_sql_string($c_email) . "', '" . password_hash($c_password, PASSWORD_BCRYPT) . "', '" . c_security::anti_sql_string(c_security::get_ip()) . "')");

                    c_response::$c_register = "success";
                    return true;
                } else {
                    c_response::$c_register = "email_already_taken";
                    return false;
                }
            }
            else{
                c_response::$c_register = "invalid_email";
                return false;
            }
        } else {
            c_response::$c_register = "username_already_taken";
            return false;
        }
    } else {
        c_response::$c_register = "empty_data";
        return false;
    }
}
