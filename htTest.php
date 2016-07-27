<?php
$html1 = "test.html";
$html2 = "test2.html";
$htaccess = ".htaccess";
$string1 = "<html><head><title>Hello</title></head><body>Hello World</body></html>";
$string2 = "<html><head><title>Hello</title></head><body>You have been redirected</body></html>";
$string3 = "redirect 301 /test.html /test2.html";
$handle1 = fopen($html1, "w");
$handle2 = fopen($html2, "w");
$handle3 = fopen($htaccess, "w");

fwrite($handle1, $string1);
fwrite($handle2, $string2);
fwrite($handle3, $string3);

$http = curl_init($_SERVER['SERVER_NAME'] . "/test.html");
$result = curl_exec($http);
$code = curl_getinfo($http, CURLINFO_HTTP_CODE);

if($code == 301) {
    echo ".htaccess works";
} else {
    echo ".htaccess doesn't work";
}
?>