<?php
/*
 * 策略模式
 */
// 策略模式，策略就是算法和变化，策略模式就是对算法和变化的封装。是条件选择从客户端到服务端的转移。客户端与算法类的彻底隔离。
//场景： 沃尔玛要做一个收银软件。有打8折，打5折等，有每满100减20等。

abstract class Pay{
    public $cash='';
    public $total='';
    
    public function getResult(){
        return $this->total;
    }
}


class Discount extends Pay{
    public function __construct($cash=''){
        $this->cash = $cash;
    }
    
    public function algorithm($discount="0.8"){
        $this->total = $this->cash*$discount ;
        return $this->getResult();
    }
}


class Reduce extends Pay{
    private $satisfied = 100;
    private $return_cash = 20;
    public function __construct($cash=''){
        $this->cash = $cash;
    }
    
    public function algorithm(){
        $this->total = $this->cash - floor($this->cash/$this->satisfied)*$this->return_cash;
        return $this->total;
        
    }
}


class Context{
    private $obj;
    private $price;
    public function __construct($type='', $price=''){
        $this->price = $price;
        switch ($type){
            case 1:
                $this->obj = new Discount($price);
                break;
            case 2:
                $this->obj = new Reduce($price);
                break;
        }
    }
    
    public function algorithm(){
        return $this->obj->algorithm();
    }
}

$total = new Context(2,188);

echo $total->algorithm();