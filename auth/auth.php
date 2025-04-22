<?php 

    function load_user_data($con) {
        $select_user_query = "SELECT * FROM User WHERE id = " . $_SESSION["user_id"] . ";";
        $user_query_result = $con->query($select_user_query);

        if ($user_query_result->num_rows == 0) {
            header("Location: ./auth/logout.php");
            exit();
        }

        return $user_query_result->fetch_assoc();
    }

    function generate_token($con, $id) {
        $token = bin2hex(random_bytes(32));

        $update_token_query = "UPDATE User SET token = '" . $token . "' WHERE id = " . $id . ";";
        $update_token_result = $con->query($update_token_query);

        setcookie(
            'auto_login_token', 
            $token, 
            time() + 60 * 60 * 24 * 30, 
            '/', 
            '', 
            true, 
            true
        ); // 30 days expiry

        $_SESSION['user_id'] = $id;
    }    

?>