<?php

include_once ("c_settings.php");
include_once ("c_security.php");
include_once ("c_response.php");

function c_login($c_username, $c_password) {
    global $c_con; // ghetto asf(i dont like funcs!)

    if (!empty($c_username)) {
        $c_user_check = $c_con->query("SELECT * FROM c_data WHERE c_username='" . c_security::anti_sql_string($c_username) . "'");
        if ($c_user_check->num_rows != 0) {
            if (!empty($c_password)) {
                while ($c_row = $c_user_check->fetch_assoc()) {
                    if(password_verify($c_password, $c_row["c_password"])){
                        $c_con->query("UPDATE c_data SET c_ip='".c_security::anti_sql_string(c_security::get_ip())."' WHERE c_username='".c_security::anti_sql_string($c_username)."'");

                        c_response::$c_login = "success";
                        return true;
                    }
                    else{
                        c_response::$c_login = "wrong_password";
                        return false;
                    }
                }
            }
            else{
                c_response::$c_login = "empty_password";
                return false;
            }
        }
        else{
            c_response::$c_login = "invalid_username";
            return false;
        }
    }
    else{
        c_response::$c_login = "empty_username";
        return false;
    }
}

function c_api_login($c_username, $c_password, $c_hwid){
    global $c_con; // ghetto asf(i dont like funcs!)

    if (!empty($c_username)) {
        $c_user_check = $c_con->query("SELECT * FROM c_data WHERE c_username='" . c_security::anti_sql_string($c_username) . "'");
        if ($c_user_check->num_rows != 0) {
            if (!empty($c_password)) {
                while ($c_row = $c_user_check->fetch_assoc()) {
                    if(password_verify($c_password, $c_row["c_password"])){
                        if ($c_row["c_expires"] > time()) { // sub check
                            if (strlen($c_row["c_hwid"]) != 0) {
                                if ($c_row["c_hwid"] == $c_hwid) {
                                    $c_ip = c_security::get_ip(); // ghetto asf(i dont like funcs!)
                                    $c_con->query("UPDATE c_data SET c_ip='".c_security::anti_sql_string($c_ip)."' WHERE c_username='".c_security::anti_sql_string($c_username)."'");

                                    $token = c_security::random_string(43); //here i generate an random string and use it as a token
                                    $time = time() + 180; //3 min

                                    $c_con->query("INSERT INTO c_tokens (c_token, c_expires) VALUES ('".c_security::anti_sql_string($token)."', '".c_security::anti_sql_string($time)."')");

                                    c_response::$c_api_login = "logged_in|" . $token; // :D
                                    return true;
                                } else {
                                    c_response::$c_api_login = "wrong_hwid";
                                    return false;
                                }
                            }
                            else{
                                $c_con->query("UPDATE c_data SET c_hwid='".c_security::anti_sql_string($c_hwid)."' WHERE c_username='".c_security::anti_sql_string($c_username)."'");
                                $c_ip = c_security::get_ip(); // ghetto asf(i dont like funcs!)
                                $c_con->query("UPDATE c_data SET c_ip='".c_security::anti_sql_string($c_ip)."' WHERE c_username='".c_security::anti_sql_string($c_username)."'");

                                $token = c_security::random_string(43); //here i generate an random string and use it as a token
                                $time = time() + 180; //3 min

                                $c_con->query("INSERT INTO c_tokens (c_token, c_expires) VALUES ('".c_security::anti_sql_string($token)."', '".c_security::anti_sql_string($time)."')");

                                c_response::$c_api_login = "logged_in|" . $token; // :D
                                return true;
                            }
                        }
                        else{
                            c_response::$c_api_login = "no_sub";
                            return false;
                        }
                    }
                    else{
                        c_response::$c_api_login = "wrong_password";
                        return false;
                    }
                }
            }
            else{
                c_response::$c_api_login = "empty_password";
                return false;
            }
        }
        else{
            c_response::$c_api_login = "invalid_username";
            return false;
        }
    }
    else{
        c_response::$c_login = "empty_username";
        return false;
    }
}
