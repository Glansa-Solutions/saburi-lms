<?php

function encrypt($data, $key, $iv) {
    $cipher = "aes-256-cbc";
    $options = 0;
    $encrypted = openssl_encrypt($data, $cipher, $key, $options, $iv);
    return base64_encode($encrypted);
}

function decrypt($encryptedData, $key, $iv) {
    $cipher = "aes-256-cbc";
    $options = 0;
    $decrypted = openssl_decrypt(base64_decode($encryptedData), $cipher, $key, $options, $iv);
    return $decrypted;
}

// Example usage
$dataToEncrypt = "company";
$key = "your_secret_key"; // Change this to your secret key
$iv = openssl_random_pseudo_bytes(16); // Initialization Vector, should be random and unique

$encryptedData = encrypt($dataToEncrypt, $key, $iv);
echo "Original: $dataToEncrypt\n";
echo "Encrypted: $encryptedData\n";

$decryptedData = decrypt($encryptedData, $key, $iv);
echo "Decrypted: $decryptedData\n";

?>
