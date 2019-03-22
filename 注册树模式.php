<?php
/**
注册树模式又称注册模式或注册器模式。注册树模式通过将对象实例注册到一棵全局的对象树上，需要的时候从对象树上采摘的模式设计方法。和果树不同的是，果子只能采摘一次，而注册树上的实例却可以无数次获取。

使用了注册树模式后，对于实例，我们能够更好地统筹管理安排，就像使用全局变量一样的方便实用。


 */
/**
 * Class Register 注册树类
 */
class Register
{
    // 树的枝干-用于储存树上的果实（实例）
    public static $objects;

    /**
     * 将实例插入注册树中
     *
     * @param $alias 对象别名-注册树中的名称
     * @param $object 对象实例
     */
    public static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    /**
     * 从注册树中读取实例
     *
     * @param $alias 对象别名-注册树中的名称
     *
     * @return mixed 返回的对象实例
     */
    public static function get($alias)
    {
        if (isset(self::$objects[$alias])) {
            return self::$objects[$alias];
        } else {
            echo '您要找的对象实例不存在哦<br>';
        }

    }

    /**
     * 销毁注册树中的实例
     *
     * @param $alias 对象别名-注册树中的名称
     */
    public static function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}

/**
 * Class demo 演示类
 */
class demo
{
    /*
     * 测试方法
     */
    public function test()
    {
        echo '看这里看这里<br><br>';
    }
}

// 实例化测试类，获取对象实例
$demo = new demo();
// 注册到树上
$tree = Register::set('de', $demo);
// 取出来
$de_true = Register::get('de');
// 测试
$de_true->test();
// 销毁
Register::_unset('de');
// 尝试再次取出来
$de_true_two = Register::get('de');
// 尝试再次测试
$de_true_two->test();