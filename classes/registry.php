<?php

class Registry {

    /**
     * Статическое хранилище для данных
     */
    protected static $store = array();
 
    /**
     * Защита от создания экземпляров статического класса
     */
    function __construct() {}
    function __clone() {}
 
    /**
     * Проверяет существуют ли данные по ключу
     *
     * @param string $name
     * @return bool
     */
    public static function exists($name) 
    {
    	return isset(self::$store[$name]);
    }
 
    /**
     * Возвращает данные по ключу или null, если не данных нет
     *
     * @param string $name
     * @return unknown
     */
    public function __get($name) 
    {
        return (isset(self::$store[$name])) ? self::$store[$name] : null;
    }
 
    /**
     * Сохраняет данные по ключу в статическом хранилище
     *
     * @param string $name
     * @param unknown $obj
     * @return unknown
     */
    public function __set($name, $obj) 
    {
        return self::$store[$name] = $obj;
    }

}

?>
