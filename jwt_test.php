<?php
//jwt => header.payload.signature

/**
 * header
 */
$header  = [
    'alg' => 'HS256', //HMAC - SHA256
    'typ' => 'JWT'
];
//transforma em json
$header_json = json_encode($header);
//transforma em base64
$header_base64 = base64_encode($header_json);
echo 'Header: ' . $header_base64;
echo "\n";

/**
 * payload
 */
$payload = [
    'first_name' => 'Anderson',
    'last_name' => 'Reis',
    'email' => 'admin@user.com',
    'exp' => (new \DateTime())->getTimestamp()
];
//transforma em json
$payload_json = json_encode($payload);
//transforma em base64
$payload_base64 = base64_encode($payload_json);
echo 'Payload: ' . $payload_base64;
echo "\n";

$key = '1978hasduifewklnmlkdjsaklfhirehnbdjknfkjgfdjk';

$signature = hash_hmac('sha256', "$header_base64.$payload_base64", $key, true);
$signature_base64 = base64_encode($signature);
echo 'Signature: ' . $signature_base64;
echo "\n";

$token = "$header_base64.$payload_base64.$signature_base64";
echo 'TOKEN: ' . $token;