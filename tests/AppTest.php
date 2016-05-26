<?php

class AppTest extends PHPUnit_Framework_TestCase
{
    public function testDi()
    {
        $app = new \Bootdi\App();
        $this->assertInstanceOf(\Bootdi\App::class, $app->getInstance());
    }
}
