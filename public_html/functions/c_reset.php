<?php
include_once ("c_settings.php");
include_once ("c_security.php");
include_once ("c_response.php");

function c_change_pass($c_username, $c_old_password, $c_new_password){
	global $c_con;

	if(!empty($c_username) && !empty($c_old_password) && !empty($c_new_password)){
		 $c_user_check = $c_con->query("SELECT * FROM c_data WHERE c_username='" . c_security::anti_sql_string($c_username) . "'");
		 if ($c_user_check->num_rows != 0) {
		 		while ($c_row = $c_user_check->fetch_assoc()) {
                    if(password_verify($c_old_password, $c_row["c_password"])) {
                        $c_new_password = password_hash($c_new_password, PASSWORD_BCRYPT);
                        $c_con->query("UPDATE c_data SET c_password='" . c_security::anti_sql_string($c_new_password) . "'WHERE c_username='".c_security::anti_sql_string($c_username)."'");
                        c_response::$c_reset = "success";
                        return true;
                    }
                    else{
                    	c_response::$c_reset = "wrong_password";
                    	return false;
                    }
                }
		 }
		 else{
		 	c_response::$c_reset = "invalid_username";
			return false;
		 }
	}
	else{
		c_response::$c_reset = "empty_data";
		return false;
	}
}

function c_forgot_password($c_email){
    global $c_con;

    $c_email_check = $c_con->query("SELECT * FROM c_data WHERE c_email='" . c_security::anti_sql_string($c_email) . "'");
    if ($c_email_check->num_rows != 0) {
        $c_token = c_security::random_string(43);
        $c_time = time() + 600; //10 minutes
        $c_con->query("INSERT INTO c_resets (c_token, c_email, c_expires) VALUES ('$c_token', '" . c_security::anti_sql_string($c_email) . "', '$c_time')");
        if (mail($c_email, "reset_your_password", "reset your password, your reset token : " . $c_token, "From: noreply @ company . com")) {
            c_response::$c_reset = "success";
            return true;
        } else {  //you need to setup the email function to work with it (untested cause im lazy) any bugs report on my github or my discord
            c_response::$c_reset = "email_was_not_sent";
            return false;
        }
    } else {
        c_response::$c_reset = "invalid_email";
        return false;
    }
}

function c_new_password($c_token, $c_new_password){
    global $c_con;

	if(!empty($c_token) && !empty($c_new_password)) {
		$c_token_check = $c_con->query("SELECT * FROM c_resets WHERE c_token='".c_security::anti_sql_string($c_token)."'");
		if ($c_token_check->num_rows != 0) {
			while($c_row = $c_token_check->fetch_assoc()){
				if($c_row["c_done"] != 1){
					$c_email = $c_row["c_email"];
					$c_email_check = $c_con->query("SELECT * FROM c_data WHERE c_email='".c_security::anti_sql_string($c_email)."'");
					if($c_email_check->num_rows != 0){
						$c_hashed_password = password_hash($c_new_password, PASSWORD_BCRYPT);
						$c_con->query("UPDATE c_data SET c_password='".$c_hashed_password."' WHERE c_email='".$c_email."'"); //shitcode.su
						$c_con->query("UPDATE c_resets SET c_done='1' WHERE c_token='".c_security::anti_sql_string($c_token)."'");

						c_response::$c_reset = "success";
						return true;
					}
					else{
						c_response::$c_reset = "unexpected_bug"; //lol
						return false;
					}
				}
				else{
					c_response::$c_reset = "already_reseted";
					return false;
				}
			}
		}
		else{
			c_response::$c_reset = "unexistent_token";
			return false;
		}
	}
	else{
		c_response::$c_reset = "empty_data";
		return false;
	}
}
