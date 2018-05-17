<?php
class Factory{   //����һ�������Ĺ�����
    static public function fac($id){   //����һ�����ض���ʵ���ľ�̬����
        switch ($id){
            case 1:
                return new A();
                break;
            case 2:
                return new B();
                break;
            case 3:
                return new C();
                break;
            default: 
                return new D();
                break;
        }
    }
    
}

interface Fac{
    public function getName();
}

class A implements Fac{
    
    private $name = 'AAAAAAA';
    public function getName() {
        return $this->name;
    }
}

class B implements Fac{

    private $name = 'BBBBBBBB';
    public function getName() {
        return $this->name;
    }
}

class C implements Fac{

    private $name = 'CCCCCCCCCCCC';
    public function getName() {
        return $this->name;
    }
}


class D implements Fac{

    private $name = 'DDDDDDDDDDDD';
    public function getName() {
        return $this->name;
    }
}

$sw = Factory::fac(6);
if($sw instanceof  Fac){
    echo $sw->getName();
}

$sw2 = Factory::fac(2);
$sw2->getName();