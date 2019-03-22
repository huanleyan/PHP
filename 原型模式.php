<?php
/*
原型模式是一种创建者模式，其特点在于通过“复制”一个已经存在的实例来返回新的实例,而不是新建实例。

原型模式中主要角色
抽象原型(Prototype)角色：声明一个克隆自己的接口
具体原型(Concrete Prototype)角色：实现一个克隆自己的操作
适用性

当一个系统应该独立于它的产品创建、构成和表示时，要使用Prototype模式
当要实例化的类是在运行时刻指定时，例如动态加载
为了避免创建一个与产品类层次平等的工厂类层次时；
当一个类的实例只能有几个不同状态组合中的一种时。建立相应数目的原型并克隆它们可能比每次用合适的状态手工实例化该类更方便一些
*/

interface PrototypeDemo {
    public function copy();
}

class ConcretePrototype implements PrototypeDemo{
    private $_obj = null;
    
    public function __construct($obj){
        $this->_obj = $obj;
    }
    
    public function copy(){
        return clone $this->_obj;
    }
}

class Demo{}

$demo = new Demo();
$proto1 = new ConcretePrototype($demo);
$proto2 = $proto1->copy();


