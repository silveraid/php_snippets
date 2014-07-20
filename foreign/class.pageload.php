<?php

// Origin:
// http://www.askaboutphp.com/44/cacti-using-cacti-to-monitor-web-page-loading-part-1.html

class PageLoad {

    var $siteURL = "";
    var $pageInfo = "";

    /*
    * sets the URLs to check for loadtime into an array $siteURLs
    */
    function setURL($url) {
        if (!empty($url)) {
            $this->siteURL = $url;
            return true;
        }
        return false;
    }

    /*
    * extract the header information of the url
    */
    function doPageLoad() {
        $u = $this->siteURL;
        if(function_exists('curl_init') && !empty($u)) {
            $ch = curl_init($u);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_ENCODING, "gzip");
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_NOBODY, false);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);

            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)");
            $pageBody = curl_exec($ch);
            $this->pageInfo = curl_getinfo($ch);
            curl_close ($ch);

            return true;
        }
        return false;
    }


    /*
    * compile the page load statistics only
    */
    function getPageLoadStats() {
        $info = $this->pageInfo;

        //stats from info
        $s['dest_url'] = $info['url'];
        $s['content_type'] = $info['content_type'];
        $s['http_code'] = $info['http_code'];
        $s['total_time'] = $info['total_time'];
        $s['size_download'] = $info['size_download'];
        $s['speed_download'] = $info['speed_download'];
        $s['redirect_count'] = $info['redirect_count'];
        $s['namelookup_time'] = $info['namelookup_time'];
        $s['connect_time'] = $info['connect_time'];
        $s['pretransfer_time'] = $info['pretransfer_time'];
        $s['starttransfer_time'] = $info['starttransfer_time'];

        return $s;
    }
}
?>
