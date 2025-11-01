<?php

// Include the get-access-token.php
require 'initToken.php';
require_once("../base.php");

$input = getDataFromJsonObj();
if ($input == null) return;
$title = $input["title"];
$body = $input["body"];
$token = $input["token"];


// Path to your service account key file
$serviceAccountKeyFile = 'services.json';

// Obtain the OAuth 2.0 Bearer Token
$accessToken = getAccessToken($serviceAccountKeyFile);



$url = "https://fcm.googleapis.com/v1/projects/zeesend-f99e8/messages:send";

// Prepare FCM message data
$datamsg = array(
    'title' => $title,
    'body' => $body
);
$arrayToSend = array('token' => $token, 'data' => $datamsg);

$json = json_encode(['message' => $arrayToSend]);

// Prepare headers
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer ' . $accessToken;

// Initialize curl session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Send the request
$response = curl_exec($ch);

// Check for curl errors
if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
}

// Close curl session
curl_close($ch);

?>