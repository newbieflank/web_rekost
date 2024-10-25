<?php

class Encrypt
{
    private static $encryptionMethod = 'aes-256-cbc';
    private static $secretKey = 'Jedu_is_The_Best';
    private static $secretIv = 'JustBUYtheLiSenCeBRO';

    // Encrypt data
    public static function encrypt($data)
    {

        $ivLength = openssl_cipher_iv_length(self::$encryptionMethod);
        $iv = openssl_random_pseudo_bytes($ivLength);


        $encryptedData = openssl_encrypt($data, self::$encryptionMethod, self::$secretKey, 0, $iv);


        return base64_encode($encryptedData . '::' . $iv);
    }


    public static function decrypt($data)
    {
        list($encryptedData, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encryptedData, self::$encryptionMethod, self::$secretKey, 0, $iv);
    }
}
