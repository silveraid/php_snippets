<?php

if(!function_exists('curl_init')) {

    die("FATAL: pageload_local.php requires php-curl to be installed!\n");
}

if (empty($_GET["d"])) {

    die("Missing parameter!\n");
}

$domain = $_GET["d"];


//
//
//

$ch = curl_init($domain);

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);

// The user agent string of the Chrome 37.0.2049.0 =|8-)
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36");


//
//
//

$page_body = curl_exec($ch);
$page_info = curl_getinfo($ch);
curl_close ($ch);


//
//
//

// print_r($page_info);

if (!is_array($page_info)) {

    die("FATAL: Internal error!");
}

print("http_code:" . $page_info['http_code'] . " ");
print("total_time:" . $page_info['total_time'] . " ");
print("namelookup_time:" . $page_info['namelookup_time'] . " ");
print("connect_time:" . $page_info['connect_time'] . " ");
print("pretransfer_time:" . $page_info['pretransfer_time'] . " ");
print("size_download:" . $page_info['size_download'] . " ");
print("starttransfer_time:" . $page_info['starttransfer_time'] . " ");
print("\n");

?>
