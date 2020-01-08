<?php


namespace Yunbuye\ThinkFacade\Tests;


use PHPUnit\Framework\TestCase;

class MyFacadeTest extends TestCase
{
    public function testMock()
    {
        MyFacade::shouldReceive('get')->with('mykey')->andReturn('myvalue');
        $return = MyFacade::get('mykey');
        $this->assertTrue('myvalue' == $return);
    }
}