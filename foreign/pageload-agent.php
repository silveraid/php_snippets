#! /usr/bin/php -q
<?php

// Origin:
// http://www.askaboutphp.com/44/cacti-using-cacti-to-monitor-web-page-loading-part-1.html

//include the class
include_once 'class.pageload.php';
// read in an argument - must make sure there's an argument to use
if ($argc==2) {

    //read in the arg.
    $url_argv = $argv[1];
    if (!eregi('^http://', $url_argv)) {
        $url_argv = "http://$url_argv";
    }
    // check that the arg is not empty
    if ($url_argv!="") {

        //initiate the results array
        $results = array();

        //initiate the class
        $lt = new PageLoad();

        //set the page to check the loadtime
        $lt->setURL($url_argv);

        //load the page
        if ($lt->doPageLoad()) {
            //load the page stats into the results array
            $results = $lt->getPageLoadStats();
        } else {
            //do nothing
            print "";
        }

        //print out the results
        if (is_array($results)) {
            //expecting only one record as we only passed in 1 page.
            $output = $results;

            print "dns:".$output['namelookup_time'];
            print " con:".$output['connect_time'];
            print " pre:".$output['pretransfer_time'];
            print " str:".$output['starttransfer_time'];
            print " ttl:".$output['total_time'];
            print " sze:".$output['size_download'];
            print " spd:".$output['speed_download'];
        } else {
            //do nothing
            print "";
        }
    }
} else {
    //do nothing
    print "";
}
?>
