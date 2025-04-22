<?php

    /* 
     * add permissions to upload correctly
     * sudo chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/projects/gzz/uploads
    */

    function upload_image($folder, $image, $con, $id) {
        $imageName = $image['name'];
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageName = $id . '.' . $extension;
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $maxSize = 2 * 1024 * 1024;

        if ($imageSize > $maxSize) {
            echo "L'immagine supera la dimensione massima consentita di 2MB!";
            return;
        }

        $relativePath = $folder . "/" . $imageName;
        $absolutePath = __DIR__ . "/" . $relativePath;

        if (!is_dir(dirname($absolutePath))) {
            mkdir(dirname($absolutePath), 0755, true);
        }

        move_uploaded_file($imageTmpName, $absolutePath);

        $query = "";

        if ($folder == "profile_pictures") {
            $query = "UPDATE User SET profile_picture = '" . $relativePath . "' WHERE id = " . $id . ";";
        } else if ($folder == "startup_banners") {
            $query = "UPDATE Startup SET banner = '" . $relativePath . "' WHERE id = " . $id . ";";
        }

        $result = $con->query($query);

        if (!$result) {
            echo "Errore durante il carimaneto immagine!";
            return;
        }
    }

?>