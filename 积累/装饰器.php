<?php
/*    装饰模式，动态的给一个对象添加一些额外的职责，就增加的功能来说，装饰模式比生成子类更为灵活。设计模式之装饰模式。每个装饰对象的实现和如何使用这个对象分离了，每个装饰对象只关心自己的功能，
 *    不需要关心如何被添加到对象链中。
 * 
 * 饰模式是为已有的功能动态的添加更多功能的一种方式。当系统需要新功能的时候，是向旧类中添加新代码。这些新代码通常装饰了原有的类的核心职责或主要行为。
 新加入的代码仅仅是在满足一定特定条件下才会被需要。而装饰模式提供了一个解决方案。把每个要装饰的功能放在单独类中。需要执行特殊行为时，客户端代码可以有选择的有顺序的去使用装饰功能包装对象。
装饰模式就是把类中的装饰功能删掉，简化原类，把核心职责和装饰区分开。
场景：数据加密和数据过滤是我们在写入数据库前要做的工作，那么先加密再过滤和先过滤再加密，结果肯定是不一样的。所以，保证加密和过滤这2个类彼此独立，如果使用，在客户端进行不同的组合。
*/

abstract class Component{
    public function operation(){
        
    }
}


class ConcreteComponent extends Component{
    public function operation(){
        echo "具体对象操作";
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
        echo "具体装饰对象A的操作";
    }
}


class ConcreteDecoratorB extends Decorator{
    public function concteteOperation(){
        $this->operation();
        $this->addState = "new state";
        $this->addBehavior();
        echo "具体装饰对象B的操作";
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















