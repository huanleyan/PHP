<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 15/8/17
 * Time: 下午3:35
 */

class Singleton {
    private static $_instances = array();

    protected function __construct()
    {
    }

    final public function __clone()
    {
        trigger_error("clone method is not allowed.", E_USER_ERROR);
    }

    /**
     * @return static
     */
    final public static function getInstance()
    {
        $c = get_called_class();
        if(!isset(self::$_instances[$c])) {
            self::$_instances[$c] = new $c;
        }
        return self::$_instances[$c];
    }
} 