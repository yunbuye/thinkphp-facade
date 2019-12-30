<?php


namespace Xwpd\ThinkFacade\Tests;


use Xwpd\ThinkFacade\Facade;

/**
 * Class MyFacade
 * @method mixed get($key)
 * @package Xwpd\ThinkTesting\Tests
 */
class MyFacade extends Facade
{
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return MyService::class;
    }
}