<?php


namespace Yunbuye\ThinkFacade;


use Mockery\MockInterface;
use Mockery;
use think\Container;

class Facade extends \think\Facade
{

    /**
     * Convert the facade into a Mockery spy.
     *
     * @return MockInterface
     */
    public static function spy()
    {
        $class = static::getFacadeAccessor();
        $spy = $class ? Mockery::spy($class) : Mockery::spy();
        static::swap($spy);
        return $spy;
    }

    /**
     * Initiate a mock expectation on the facade.
     *
     * @return \Mockery\Expectation
     */
    public static function shouldReceive()
    {
        $mock = static::createFreshMockInstance();

        return $mock->shouldReceive(...func_get_args());
    }

    /**
     * Create a fresh mock instance for the given class.
     *
     * @return \Mockery\MockInterface
     */
    protected static function createFreshMockInstance()
    {
        $mock = static::createMock();
        static::swap($mock);
        $mock->shouldAllowMockingProtectedMethods();
        return $mock;
    }

    /**
     * Create a fresh mock instance for the given class.
     *
     * @return \Mockery\MockInterface
     */
    protected static function createMock()
    {
        $class = static::getFacadeAccessor();
        return $class ? Mockery::mock($class) : Mockery::mock();
    }

    /**
     * Hotswap the underlying instance behind the facade.
     *
     * @param mixed $instance
     * @return void
     */
    public static function swap($instance)
    {
        Container::getInstance()->bindTo(static::getFacadeAccessor(), $instance);
    }

    /**
     * @return string
     */
    static protected function getFacadeAccessor()
    {
        $class = static::class;
        $facadeClass = static::getFacadeClass();
        if ($facadeClass) {
            $class = $facadeClass;
        } elseif (isset(self::$bind[$class])) {
            $class = self::$bind[$class];
        }
        return $class;
    }

}