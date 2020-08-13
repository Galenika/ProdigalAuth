<?php
include_once ("c_settings.php");
include_once ("c_security.php");
include_once ("c_response.php");

function c_activate($c_username, $c_key) {
    global $c_con; //limao

    $key_check = $c_con->query("SELECT * FROM c_keys WHERE c_key='".c_security::anti_sql_string($c_key)."'");
    if ($key_check->num_rows != 0) {
        while ($c_row = $key_check->fetch_assoc()) {
            if($c_row["c_used"] != 1) {
                $user_check = $c_con->query("SELECT * FROM c_data WHERE c_username='".c_security::anti_sql_string($c_username)."'");
                if ($user_check->num_rows != 0) {
                    while ($c_row2 = $user_check->fetch_assoc()) {
                        $expires = $c_row2["c_expires"];
                        $real_days = "+" . $c_row["c_days"] . " days";

                        if (strlen($expires) != 0) {
                            if (time() > $expires) {
                                $time_to_update = strtotime($real_days, time());
                            } else {
                                $time_to_update = strtotime($real_days, $expires);
                            }
                        } else {
                            $time_to_update = strtotime($real_days, time());
                        }

                        $c_con->query("UPDATE c_data SET c_expires='".c_security::anti_sql_string($time_to_update)."' WHERE c_username='".c_security::anti_sql_string($c_username)."'");
                        $c_con->query("UPDATE c_keys SET c_used='1' WHERE c_key='".c_security::anti_sql_string($c_key)."'");
                        c_response::$c_activate = "success";
                        return true;
                    }
                }
                else{
                    c_response::$c_activate = "unexistent_user";
                    return false;
                }
            }
            else {
                c_response::$c_activate = "already_used_key";
                return false;
            }
        }
    }
    else{
        c_response::$c_activate = "unexistent_key";
        return false;
    }
}
