<?php 
require_once("PDO.php");
$salt = "4";
$secret = "2598y2tr93gjh387g3gf8f23fi23n4f78324fh32nf7832";


function deTockener ($token) {
    $salt = "4";
    $secret = "2598y2tr93gjh387g3gf8f23fi23n4f78324fh32nf7832";
    $token = openssl_decrypt(
        $token,
        "aes-256-cbc",
        $secret,
        null,
        null,
        );

        
    return $token;
}










?>