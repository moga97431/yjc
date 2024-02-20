<?php
// این وبسرویس قبلا اپن شده بود.
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');
$get = file_get_contents('https://www.yjc.ir/fa/allnews');
preg_match_all('<img alt="(.*?)" class="list_img" src="(.*?)" width="(.*?)"/>', $get, $img);
preg_match_all('<a href="/fa/news/(.*?)/(.*?)" target="_blank" title="(.*?)">',$get,$url);
for ($i = 1; $i <= count($url[3])-1; $i++) {
	$results[$i]['Id'] =  $url[1][$i];
	$results[$i]['Title'] =  $url[3][$i];
	$results[$i]['Link'] =  'https://www.yjc.ir/fa/news/' . $url[1][$i] . '/' . $url[2][$i];
	$results[$i]['Photo'] =  $img[2][$i];
}
echo json_encode([ 'results' => $results], 128 | 256);
