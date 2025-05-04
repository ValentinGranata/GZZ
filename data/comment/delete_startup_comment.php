<?php 

    include_once "../db.php";
    include_once "../../auth/auto_login.php";
    include_once "../../auth/auth.php";

    $user = load_user_data($con);
    $user_id = $user["id"];
    $comment_id = $_POST["comment_id"];

    if (!isset($comment_id)) {
        exit("Invalid comment id.");
    }

    $delete_comment_query = "DELETE FROM Comment WHERE id = " . $comment_id . " AND owner_id = " . $user_id . ";";
    $delete_comment_result = $con->query($delete_comment_query);

    if ($delete_comment_result) {
        echo json_encode(array(
            "status" => "success",
            "message" => "Comment deleted successfully."
        ));
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Error deleting comment."
        ));
    }
    
    $redirectUrl = isset($_POST["redirect_url"]) ? $_POST["redirect_url"] : '/projects/gzz/index.php';
    header('Location: ' . $redirectUrl);
    exit();

?>