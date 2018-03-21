<?php
/**
 * Order by apieye.com
 * @param num 密码的随机最小长度
 * @param num 密码的随机最大长度
 * @param bool 是否使用特殊字符
 */
function random_passwd($min_len=8,$max_len=16,$special=FALSE){
    $passwd_len = mt_rand($min_len,$max_len);
    $random_str = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $special_str = '!@#$%^&*()_+,./;\[]{}:|<>?';
    if($special!=FALSE){
        $random_str .= $special_str;
    }
    $random_passwd = '';
    while (strlen($random_passwd)<$passwd_len){
        $random_passwd .= substr($random_str, (rand()/strlen($random_str)),1);
    }
    return $random_passwd;
}
random_passwd(8,8,false);
#会生成形如129jaios,8a8df8ew,A99aWU12这样的密码
random_passwd(8,8,true);
#会生成形如9sd<.a;w,9ad}qw1A,d9>sq1?a这样的密码