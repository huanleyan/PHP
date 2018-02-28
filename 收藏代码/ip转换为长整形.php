<?php
function my_ip2long($ip){
    list($ip1, $ip2, $ip3, $ip4) = explode(".", $ip);
    return $ip1 * pow(256, 3) + $ip2 * pow(256, 2) + $ip3 * 256 + $ip4;
}
function my_long2ip($long){
    $base = 256;
    $ip = "";
    $i = 3;
    while($long > 0){
        $ip_index = floor($long / pow(256, $i));
        $long -= pow($base, $i) * $ip_index;
        $ip .= $ip_index . ".";
        $i --;
    }
    return substr($ip, 0, - 1);
}
$ip = "192.100.100.100";
// echo sprintf("%u", ip2long($ip));//3227804772 echo "<br>";
// echo long2ip($long_num); echo "<br>";
// echo my_ip2long($ip); echo "<br>";
echo $long_num = my_ip2long($ip); echo "<br>";
echo my_long2ip($long_num);
?>