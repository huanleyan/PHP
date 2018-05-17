<?php
/*
 * 单例模式又称为职责模式，它用来在程序中创建一个单一功能的访问点，通俗地说就是实例化出来的对象是唯一的。
所有的单例模式至少拥有以下三种公共元素：
1. 它们必须拥有一个构造函数，并且必须被标记为private
2. 它们拥有一个保存类的实例的静态成员变量
3. 它们拥有一个访问这个实例的公共的静态方法
单例类不能再其它类中直接实例化，只能被其自身实例化。它不会创建实例副本，而是会向单例类内部存储的实例返回一个引用。

 */
class Single{
    private $name;
    private function __construct($name='') {
        $this->name = $name;
    }
    static private $instance;
    static public function getInstance() {
        if(!self::$instance){
            self::$instance = new self::$instance;
        };
        return self::$instance;
    }
    ////防止克隆对象
    private function __clone(){
        
    }
    
    public function getname(){
        return $this->name;
    }
    
    public function setname($name='') {
        $this->name = $name;
    }
}
$a1 = new Single();
$a2 = new Single();
$a1->setname('chenghuan');
$a2->setname('lidan');
echo $a1->getname();
echo $a2->getname();