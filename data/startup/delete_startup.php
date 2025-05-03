<?php 

    include_once "../db.php";
    include_once "../../auth/auto_login.php";
    include_once "../../auth/auth.php";

    $user = load_user_data($con);
    $user_id = $user["id"];
    $startup_id = $_POST["startup_id"];

    if (!isset($startup_id)) {
        exit("Invalid startup id.");
    }

    $delete_startup_query = "DELETE FROM Startup WHERE id = " . $startup_id . " AND owner_id = " . $user_id . ";";
    $delete_startup_result = $con->query($delete_startup_query);

    if ($delete_startup_result) {
        echo json_encode(array(
            "status" => "success",
            "message" => "Startup deleted successfully."
        ));
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Error deleting startup."
        ));
    }
    
    header("Location: /projects/gzz/index.php");
    exit();

?>