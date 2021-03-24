<?php 
DEFINE('KEY', "testtest");

$email = "Asdfaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaff";
$time = time();
$enc = $email . "|" . $time;
$encryp = encrypt_txt($enc);
$e = bin2hex($encryp);
$decr = hex2bin($e);
$d = decrypt_txt($decr);die($d);

function encrypt_txt($plaintext, $password = KEY) {
    $method = "AES-128-CBC";
    $key = hash('sha256', $password, true);
    $iv = openssl_random_pseudo_bytes(16);
    $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
    return $iv . $hash . $ciphertext;
}
function decrypt_txt($ivHashCiphertext, $password = KEY) {
    $method = "AES-128-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);
    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
  }	