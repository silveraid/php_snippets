#! /usr/bin/php -q
<?php

if(!function_exists('curl_init')) {

    die("FATAL: pageload_remote.php requires php-curl to be installed!\n");
}

if ($argc != 3) {

    die("Usage: pageload_remote.php DOMAIN HOST_IP\n");
}

$domain = $argv[1];
$host_ip = $argv[2];

if (empty($domain)|| empty($host_ip)) {

    die("Usage: pageload_remote.php DOMAIN HOST_IP\n");
}


//
//
//

$script = "http://" . $host_ip . "/pageload_local.php?d=" . $domain;

$ch = curl_init($script);

curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);

// The script is accessible through this domain ...
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: ffelhoffer.com"));

// The user agent string of the Chrome 37.0.2049.0 =|8-)
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36");


//
//
//

$page_body = curl_exec($ch);
curl_close ($ch);


//
//
//

print($page_body);


?>
