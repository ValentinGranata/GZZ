<?php 

    function get_random_startup($con, $user) {
        $startup = null;

        $select_viewed_startups_query = "SELECT startup_id FROM Interaction WHERE user_id = " . $user["id"] . " AND type = 'view';";
        $viewed_startup_result = $con->query($select_viewed_startups_query);
        
        if ($viewed_startup_result->num_rows > 0) {
            while ($row = $viewed_startup_result->fetch_assoc()) {
                $shown[] = $row["startup_id"];
            }
        }

        $select_random_startup_query = "SELECT Startup.*, User.id AS owner_id, User.name AS owner_name, User.surname AS owner_surname, User.email AS owner_email, User.profile_picture AS owner_profile_picture FROM Startup INNER JOIN User ON User.id = Startup.owner_id " . (!empty($shown) ? ("WHERE Startup.id NOT IN (" . implode(',', $shown) . ") ") : "") . " ORDER BY RAND() LIMIT 1;";
        $select_random_startup_result = $con->query($select_random_startup_query);

        if ($select_random_startup_result->num_rows <= 0) {
            $reset_view_interaction_query = "DELETE FROM Interaction WHERE user_id = " . $user["id"] . " AND type = 'view';";
            $reset_view_interaction_result = $con->query($reset_view_interaction_query);

            header("Location: /projects/gzz/index.php?type=random");
        }

        $startup = $select_random_startup_result->fetch_assoc();

        $add_view_interaction_query = "INSERT INTO Interaction (startup_id, user_id, type) VALUES (" . $startup["id"] . ", " . $user["id"] . ", 'view');";
        $add_view_interaction_result = $con->query($add_view_interaction_query);

        if (!$add_view_interaction_result) {
            exit("Errore nell'aggiunta dell'interazione.");
        }

        return $startup;
    }

    function get_startup($con, $user, $type) {
        $select_type_startup_query = "SELECT * FROM Interaction, Startup WHERE Interaction.user_id = " . $user["id"]  . " AND Interaction.type = '" . $type . "' AND Startup.id = Interaction.startup_id ORDER BY Interaction.created_at LIMIT 1;";
        $select_type_startup_result = $con->query($select_type_startup_query);
        $startup = null;
        
        if ($select_type_startup_result->num_rows == 0) {
            $startup = null;
        } else { 
            $startup = $select_type_startup_result->fetch_assoc();
        }

        return $startup;
    }

?>