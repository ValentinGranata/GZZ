<?php 

    include_once "../db.php";

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        exit("Invalid request method.");
    }

    $type = $_POST['type'];

    if ($type != "random" && $type != "repost" && $type != "saved" && $type != "liked") {
        exit("Invalid type.");
    }

    if ($type == "random") {
        $shown = isset($_POST['shown']) ? json_decode($_POST['shown'], true) : [];
        $excludeCondition = "";

        if (!empty($shown)) {
            $ids = array_map('intval', $shown);
            $excludeCondition = "WHERE id NOT IN (" . implode(',', $ids) . ")";
        }

        $query = "SELECT * FROM Startup " . $excludeCondition . " INNER JOIN User ON Startup.owner_id = User.id ORDER BY RAND() LIMIT 1;";        
        $res = $con->query($query);

        if ($res->num_rows == 0) {
            echo json_encode(['reset' => true]);
            exit();
        }

        $startup = $res->fetch_assoc();

        echo json_encode($startup);
        exit();
    } else {
        $query = "SELECT * FROM Interaction, Startup WHERE Interaction.user_id = " . $user_id  . " AND Interaction.type = '" . $type . "' AND Startup.id = Interaction.startup_id ORDER BY Interaction.created_at LIMIT 1;";
        $res = $con->query($query);

        if ($res->num_rows == 0) {
            exit("No startups found.");
        }
    }

?>