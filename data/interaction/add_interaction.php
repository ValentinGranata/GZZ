<?php

    include_once "../db.php";
    include_once "../../auth/auto_login.php";
    include_once "../../auth/auth.php";

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        exit("Invalid request method.");
    }

    $input = json_decode(file_get_contents("php://input"), true);

    $startup_id = isset($input['startup_id']) ? intval($input['startup_id']) : null;
    $type = isset($input['type']) ? $con->real_escape_string($input['type']) : null;

    $user = load_user_data($con);
    $user_id = $user["id"];

    $allowed_types = ["like", "repost", "save", "view"];

    if (!in_array($type, $allowed_types)) {
        echo json_encode(array(
            "status" => "error",
            "message" => "Invalid type."
        ));
        exit();
    }

    $check_interaction_query = "SELECT * FROM Interaction WHERE user_id = " . $user_id . " AND startup_id = " . $startup_id . " AND type = '" . $type . "';";
    $check_interaction_result = $con->query($check_interaction_query);

    if ($check_interaction_result->num_rows > 0) {
        $delete_interaction_query = "DELETE FROM Interaction WHERE user_id = " . $user_id . " AND startup_id = " . $startup_id . " AND type = '" . $type . "';";
        $con->query($delete_interaction_query);

        echo json_encode(array(
            "action" => "remove"
        ));
        exit();
    } else {
        $insert_interaction_query = "INSERT INTO Interaction (user_id, startup_id, type) VALUES (" . $user_id . ", " . $startup_id . ", '" . $type . "');";
        $con->query($insert_interaction_query);
    
        echo json_encode(array(
            "action" => "add"
        ));
        exit();
    }

?>