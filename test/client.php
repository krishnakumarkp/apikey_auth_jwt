<?php
require "../bootstrap.php";

$jwt  = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsInJvbGUiOiJhZG1pbiIsImV4cCI6MTU3MTQ3MzAwNH0.hHWpTZM8QNYNXoi5HBOJttK51vTxJReQz7YfxZvwCG4";

$url = "http://127.0.0.1/apikey_auth_jwt/person";

getAllPersons($url, $jwt);

$id = 8;
getPerson($url, $jwt, $id);



function getAllPersons($url, $jwt) {
    echo "Getting all persons...";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Accept: application/json",
        "Authorization: Bearer ".$jwt
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    var_dump($response);
}

function getPerson($url, $jwt, $id) {
    echo "Getting perosn with id#$id...";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url .'/'. $id);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Accept: application/json",
        "Authorization: Bearer ".$jwt
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    var_dump($response);
}