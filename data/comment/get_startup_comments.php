<?php 

    include_once "../db.php";
    include_once "../../auth/auto_login.php";
    include_once "../../auth/auth.php";

    function get_startup_comments($con, $startup_id) {
        $comments = array();

        $select_startup_comments_query = "SELECT *, Comment.id AS comment_id FROM Comment, User WHERE Comment.startup_id = " . $startup_id . " AND Comment.owner_id = User.id;";
        $select_startup_comments_result = $con->query($select_startup_comments_query);

        if ($select_startup_comments_result->num_rows > 0) {
            while ($row = $select_startup_comments_result->fetch_assoc()) {
                $comments[] = $row;
            }
        } else {
            $comments = array();
        }

        return $comments;
    }

?>