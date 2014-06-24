<html>
<head>
    <title>N/A</title>
</head>
<body>

<?php

/*
 *  Returns with the list of the names of the image files
 */
function file_list() {

    $filtered = array();
    $files = array_diff(scandir("."), Array(".", ".."));

    foreach ($files as $f) {

        if (preg_match("/(\.jpg|\.jpeg|\.png)$/i", $f)) {

            array_push($filtered, $f);
        }
    }

    return $filtered;
}

foreach (file_list() as $fn) {

    print ("<img src=\"resize.php?f=$fn\" />\n<br>\n<br>\n");
}

?>

</body>
</html>
