<?php

class RSA {

    //公钥加密
    protected function encryptWithPub($str,$public_key){
        $encrypted = "";
        $pu_key = openssl_pkey_get_public($public_key); // 这个函数可用来判断公钥是否是可用的
        openssl_public_encrypt($str, $encrypted, $pu_key); // 公钥加密
        $encrypted = base64_encode($encrypted); // 进行编码
        return $encrypted;
    }

    //私钥解密
    protected function decryptWithPri($str,$private_key){
        $pi_key =  openssl_pkey_get_private($private_key);
        $decrypted = '';
        openssl_private_decrypt(base64_decode($str),$decrypted,$pi_key);//私钥解密
        openssl_free_key($pi_key);
        return $decrypted;
    }

}