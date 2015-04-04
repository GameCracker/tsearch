<?php

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => "",
    'consumer_secret' => ""
);
$http_origin = $_SERVER['HTTP_ORIGIN'];
 
if ( strrpos($http_origin, "mysite1.net") || strrpos($http_origin, "mysite2") ){  
    header("Access-Control-Allow-Origin: $http_origin");
}
 
header('Content-Type: APPLICATION/json');
 
ini_SET('display_errors', 1);
require_once('TwitterAPIExchange.php');
 
 
/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
 
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?'.$_SERVER['QUERY_STRING'];
$requestMethod = 'GET';
$twitter = NEW TwitterAPIExchange($settings);
 
$api_response = $twitter ->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
 
echo $api_response;
