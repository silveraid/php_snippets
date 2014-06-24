<?php

function resize_image($fn = null, $req_width = 0) {

    if ($fn === null || $req_width <= 0)
        return false;

    $info = getimagesize($fn);
    list($orig_width, $orig_height) = $info;

    $factor = $req_width / $orig_width;

    $new_width = round($orig_width * $factor);
    $new_height = round($orig_height * $factor);

    switch ($info[2]) {
        case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($fn); break;
        case IMAGETYPE_PNG:  $image = imagecreatefrompng($fn); break;
        default: return false;
    }

    $new_image = imagecreatetruecolor($new_width, $new_height);

    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);

    $mime = image_type_to_mime_type($info[2]);
    header("Content-type: $mime");

    switch ($info[2]) {
        case IMAGETYPE_JPEG: imagejpeg($new_image, NULL, 100); break;
        case IMAGETYPE_PNG: imagepng($new_image, NULL, 100); break;
        default: return false;
    }

    imagedestroy($new_image);
}

if (!empty($_GET["f"])) {

    resize_image($_GET["f"], 500);
}

?>
