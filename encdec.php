@php
function encrypt($data, $key)
{
$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$encrypted = sodium_crypto_secretbox($data, $nonce, $key);
$result = base64_encode($nonce . $encrypted);
return $result;
}
function decrypt($data, $key)
{
$decoded = base64_decode($data);
$nonce = substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$cipherText = substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$decrypted = sodium_crypto_secretbox_open($cipherText, $nonce, $key);
return $decrypted;
}
$key = sodium_crypto_secretbox_keygen();
$encData = encrypt('saiful.rana@gmail.com', $key);
dd($encData);
$decryptedData = decrypt($encData, $key);
dd($decryptedData);
@endphp