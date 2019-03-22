<?php
use phpDocumentor\Reflection\Types\Null_;

/*
代理模式是一种结构型模式，它可以为其他对象提供一种代理以控制对这个对象的访问。
主要角色
    抽象主题角色(Subject)：
        它的作用是统一接口。此角色定义了真实主题角色和代理主题角色共用的接口，这样就可以在使用真实主题角色的地方使用代理主题角色。
    真实主题角色(RealSubject)：
        隐藏在代理角色后面的真实对象。
    代理主题角色(ProxySubject)：
        它的作用是代理真实主题，在其内部保留了对真实主题角色的引用。它与真实主题角色都继承自抽象主题角色，保持接口的统一。它可以控制对真实主题的存取，
        并可能负责创建和删除真实对象。代理角色并不是简单的转发，通常在将调用传递给真实对象之前或之后执行某些操作，当然你也可以只是简单的转发。 与适配
        器模式相比：适配器模式是为了改变对象的接口，而代理模式并不能改变所代理对象的接口。
 适用性
    为一些复杂的子系统提供一组接口
    提高子系统的独立性
    在层次化结构中，可以使用门面模式定义系统的每一层的接口
*/

abstract class Subject{     //抽象主题角色
    abstract public function action();
}


class RealSubject extends Subject { // 真实主题角色
    public function __construct() {}
    public function action() {
        echo __CLASS__.'-'.__FUNCTION__.PHP_EOL;
    }
}


// 代理主题角色
class ProxySubject extends Subject { 
    private $_realobj = null;
    
    public function __construct(){
    }
    public function action(){
        $this->_beforeAction();
        if(is_null($this->_realobj)){
            $this->_realobj = new RealSubject();
        }
        $this->_realobj->action();
        $this->_afterAction();
    }
    
    private function _beforeAction(){
        echo __FUNCTION__.PHP_EOL;
    }
    
    private function _afterAction(){
        echo __FUNCTION__.PHP_EOL;
    }
}

$proxy = new ProxySubject();
echo $proxy->action();
?>