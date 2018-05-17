<?php
/*    װ��ģʽ����̬�ĸ�һ���������һЩ�����ְ�𣬾����ӵĹ�����˵��װ��ģʽ�����������Ϊ�����ģʽ֮װ��ģʽ��ÿ��װ�ζ����ʵ�ֺ����ʹ�������������ˣ�ÿ��װ�ζ���ֻ�����Լ��Ĺ��ܣ�
 *    ����Ҫ������α���ӵ��������С�
 * 
 * ��ģʽ��Ϊ���еĹ��ܶ�̬����Ӹ��๦�ܵ�һ�ַ�ʽ����ϵͳ��Ҫ�¹��ܵ�ʱ���������������´��롣��Щ�´���ͨ��װ����ԭ�е���ĺ���ְ�����Ҫ��Ϊ��
 �¼���Ĵ��������������һ���ض������²Żᱻ��Ҫ����װ��ģʽ�ṩ��һ�������������ÿ��Ҫװ�εĹ��ܷ��ڵ������С���Ҫִ��������Ϊʱ���ͻ��˴��������ѡ�����˳���ȥʹ��װ�ι��ܰ�װ����
װ��ģʽ���ǰ����е�װ�ι���ɾ������ԭ�࣬�Ѻ���ְ���װ�����ֿ���
���������ݼ��ܺ����ݹ�����������д�����ݿ�ǰҪ���Ĺ�������ô�ȼ����ٹ��˺��ȹ����ټ��ܣ�����϶��ǲ�һ���ġ����ԣ���֤���ܺ͹�����2����˴˶��������ʹ�ã��ڿͻ��˽��в�ͬ����ϡ�
*/

abstract class Component{
    public function operation(){
        
    }
}


class ConcreteComponent extends Component{
    public function operation(){
        echo "����������";
    }
}


abstract class Decorator extends Component{
    protected $component;
    
    public function setComponent($objComponent){
        $this->component = $objComponent;
    }
    
    public function sonComponent(){
        if(empty($this->component)){
            $this->operation();
        }
    }
}


class ConcreteDecoratorA extends Decorator{
    private $addState;
    public function concteteOperation(){
        $this->operation();
        $this->addState = "new state";
        echo "����װ�ζ���A�Ĳ���";
    }
}


class ConcreteDecoratorB extends Decorator{
    public function concteteOperation(){
        $this->operation();
        $this->addState = "new state";
        $this->addBehavior();
        echo "����װ�ζ���B�Ĳ���";
    }
    public function addBehavior(){
        
    }
}

$cobj = new ConcreteComponent();
$d1Obj = new ConcreteDecoratorA();
$d2Obj = new ConcreteDecoratorB();

$d1Obj->setComponent($cobj);
$d2Obj->setComponent($d1Obj);
$d2Obj->sonComponent();















