<?php
/*
 * ����ģʽ
 */
// ����ģʽ�����Ծ����㷨�ͱ仯������ģʽ���Ƕ��㷨�ͱ仯�ķ�װ��������ѡ��ӿͻ��˵�����˵�ת�ơ��ͻ������㷨��ĳ��׸��롣
//������ �ֶ���Ҫ��һ������������д�8�ۣ���5�۵ȣ���ÿ��100��20�ȡ�

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