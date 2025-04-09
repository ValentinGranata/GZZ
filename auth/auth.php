<?php 

    function generate_token($id, $con) {
        $token = bin2hex(random_bytes(32));

        $update_token_query = "UPDATE user SET token = '" . $token . "' WHERE id = '" . $user["id"] . "';";
        mysqli_query($con, $update_token_query);

        setcookie(
            'auto_login_token', 
            $token, 
            time() + 60 * 60 * 24 * 30, 
            '/', 
            '', 
            true, 
            true
        ); // 30 days expiry
        $_SESSION['id'] = $id;
    }    

?>