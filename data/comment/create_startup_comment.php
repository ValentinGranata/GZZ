<?php 

    include_once "../db.php";
    include_once "../../auth/auto_login.php";
    include_once "../../auth/auth.php";

    $startup_id = isset($_POST["startup_id"]) ? $con->real_escape_string($_POST["startup_id"]) : '';
    $message = isset($_POST["message"]) ? $con->real_escape_string($_POST["message"]) : '';
    $user = load_user_data($con);

    if (!isset($startup_id) || !isset($message)) {
        exit("Invalid request.");
    }

    $create_comment_query = "INSERT INTO Comment (startup_id, owner_id, message) VALUES (" . $startup_id . ", " . $user["id"] . ", '" . $message . "');";
    
    $create_comment_result = $con->query($create_comment_query);

    if (!$create_comment_result) {
        exit("Error creating comment.");
    }

    header('Content-Type: application/json');
    echo json_encode(["comment_id" => $con->insert_id]);
    exit();

?>