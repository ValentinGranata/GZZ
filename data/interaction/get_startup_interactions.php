<?php 

    include_once "../db.php";
    include_once "../../auth/auto_login.php";
    include_once "../../auth/auth.php";

    function get_startup_interactions($con, $startup_id) {
        $interactions = array();

        $select_startup_interactions_query = "SELECT type, COUNT(*) AS count FROM Interaction WHERE startup_id = " . $startup_id . " GROUP BY type;";
        $select_startup_interactions_result = $con->query($select_startup_interactions_query);

        if ($select_startup_interactions_result->num_rows > 0) {
            while ($row = $select_startup_interactions_result->fetch_assoc()) {
                $interactions[$row["type"]] = $row["count"];
            }
        } else {
            $interactions = array();
        }

        return $interactions;
    }

    function get_user_interaction($con, $user_id, $startup_id) {
        $select_user_interaction_query = "SELECT type FROM Interaction WHERE user_id = " . $user_id . " AND startup_id = " . $startup_id . ";";
        $select_user_interaction_result = $con->query($select_user_interaction_query);

        $user_interactions = array();

        if ($select_user_interaction_result->num_rows > 0) {
            while ($row = $select_user_interaction_result->fetch_assoc()) {
                $user_interactions[$row["type"]] = true;
            }
        }
        
        return $user_interactions;
    }

?>