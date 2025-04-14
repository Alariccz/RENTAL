<?php
$data = "hello world";
$key = "secretkey";
$encrypted = openssl_encrypt($data, 'AES-128-ECB', $key);
echo "Encrypted Data: " . $encrypted;
?>
