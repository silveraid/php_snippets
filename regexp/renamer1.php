<?php

    $files = array_diff(scandir("."), Array(".", ".."));

    foreach ($files as $f) {

        if (preg_match("/(\.jpg|\.jpeg|\.png)$/i", $f)) {

            $oldname = $f;

            preg_match("/(.*)-([0-9]*)-(.*)\.(.*)/", $oldname, $captured);

            $newname = sprintf("%04d.%s", $captured[2], $captured[4]);

            echo "$oldname -> $newname\n";

            if (!rename($oldname, $newname)) {

                die("ERROR!");
            }
        }
    }

?>
