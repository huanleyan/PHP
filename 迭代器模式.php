<?php
/*
迭代器模式是一种行为型模式，它是一种最简单也最常见的设计模式。它可以让使用者透过特定的接口巡访容器中的每一个元素而不用了解底层的实作。
适用性
    在希望利用语言本身的遍历函数便利自定义结构时，例如PHP中的foreach函数
*/
class sample implements Iterator {
    private $_items ;
    
    public function __construct(&$data) {
        $this->_items = $data;
    }
    public function current() {
        return current($this->_items);
    }
    
    public function next() {
        next($this->_items);
    }
    
    public function key() {
        return key($this->_items);
    }
    
    public function rewind() {
        reset($this->_items);
    }
    
    public function valid() {
        return ($this->current() !== FALSE);
    }
}

// client
$data = array(1, 2, 3, 4, 5);
$sa = new sample($data);
foreach ($sa as $key => $row) {
    echo $key, ' ', $row, PHP_EOL;
}