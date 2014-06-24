<html>
<head>
    <title>N/A</title>
</head>
<body>

<?php

# .htaccess
#
# <IfModule mod_rewrite.c>
# RewriteEngine On
# RewriteRule ^app$       /image_viewer_app.php?s=list
# RewriteRule ^app/(.*)$  /image_viewer_app.php?s=$1
# </IfModule>

if (empty($_GET["s"])) {

    return;
}

if ($_GET["s"] == "list") {

    foreach (get_directory_list() as $d) {

        print ("<a href=\"app/$d\">$d</a><br>\n");
    }
}

else {

    foreach (file_list($_GET["s"]) as $fn) {

        print ("<img src=\"http://" . $_SERVER["HTTP_HOST"] . "/resize.php?f=content/" . $_GET["s"] . "/$fn\" />\n<br>\n<br>\n");
    }
}


#
#
#


function get_directory_list() {

    $directories = array();
    $files = array_diff(scandir("content"), Array(".", ".."));

    foreach ($files as $f) {

        if (is_dir("content/" . $f)) {

            array_push($directories, $f);
        }
    }

    return $directories;
}


function file_list($folder = null) {

    if (empty($folder))
        return;

    $filtered = array();
    $files = array_diff(scandir("content/{$folder}"), Array(".", ".."));

    foreach ($files as $f) {

        if (preg_match("/(\.jpg|\.jpeg|\.png)$/i", $f)) {

            array_push($filtered, $f);
        }
    }

    return $filtered;
}

?>

</body>
</html>
