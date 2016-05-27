<?php

class PimpleContainerTest extends PHPUnit_Framework_TestCase
{
    public function testProtect()
    {
        $container = new \Pimple\Container();
        $container['random_func'] = $container->protect(function () {
            return rand();
        });
    }

    public function testServices()
    {
        $container = new \Pimple\Container();
        $container['test'] = "123";
        $container['std'] = function ($c) {
            $std = new stdClass();
            $std->test = $c['test'];
            return $std;
        };
        $this->assertEquals("123", $container['std']->test);
        $container['test'] = '456';
        $this->assertEquals("123", $container['std']->test);
    }

    public function testFactory()
    {
        $container = new \Pimple\Container();
        $container['test'] = "123";
        $container['std'] = $container->factory(function ($c) {
            $std = new stdClass();
            $std->test = $c['test'];
            return $std;
        });
        $this->assertEquals("123", $container['std']->test);
        $container['test'] = '456';
        $this->assertEquals("456", $container['std']->test);
    }

    public function testObject()
    {
        $std = new stdClass();
        $this->assertInstanceOf(stdClass::class, $std);
    }
}
