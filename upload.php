<?php
include_once('ImageLib/ImageResizer.class.php');
include_once('ImageLib/ImageResizeFacade.class.php');

use \ImageLib\ImageResizeFacade as Resizer;
$allowed_extensions = array('jpeg', 'jpg', 'png');
$path = 'uploads/original/'; // upload directory

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if( !empty($_FILES['image']) ) {
        // get uploaded file extension
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        // looking for format and size validity
        if (in_array($ext, $allowed_extensions)) {
            $name = uniqid(). '.' .$ext;
            $path = $path . $name;
            // move uploaded file from temporary to uploads directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                $resizer = new Resizer();
                $resizer->resizeAndSave($path, $name);
                echo "Successfully processed";
            }
        } else {
        echo 'Error: Unsupported file!';
        }
    } else {
    echo 'Error: Image not uploaded!';
    }
}
?>