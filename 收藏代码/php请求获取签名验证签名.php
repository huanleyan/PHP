<?php
class ReqSign{
    private $sercert_cnf = [
        'a'=>'123',
        'b'=>'456'
    ];
    
    public function get_sign($secert_key, $params=[]) {
        $sercert = $this->sercert_cnf;
        if(!array_key_exists($secert_key, $sercert)){
            $err_msg = 'key尚未进行设置';
            return $err_msg;
        }
        $app_sercert = $sercert[$secert_key];
        $str = '';
        if(!empty($params)){
            ksort($params);
            foreach ($params as $key=>$param){
                if($str){
                    $str .= $key."=".$param;
                }else{
                    $str = $key.'='.$param;
                }
            }
        }
        $str.=$app_sercert;
        $sign = md5($str);
        return $sign;
    }
    
    public function check_sign($secret_key, $params, $parm_sign){
        $sercert = $this->sercert_cnf;
        if(!array_key_exists($secret_key, $sercert)){
            $err_msg = 'key尚未进行设置';
            return $err_msg;
        }
        $app_sercert = $sercert[$secret_key];
        $str = '';
        if(!empty($params)){
            ksort($params);
            foreach ($params as $key=>$param){
                if($str){
                    $str .= $key."=".$param;
                }else{
                    $str = $key.'='.$param;
                }
            }
        }
        $str.=$app_sercert;
        $sign = md5($str);
        if($sign != $parm_sign){
            return false;
        }else{
            return true;
        }
    }
  
}

$a = new ReqSign();
echo $b = $a->get_sign('a',[1,2,3,4]);
echo $a->check_sign('a', [1,2,3,4], $b);