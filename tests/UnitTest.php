<?php
# tests/UnitTest.php 文件
# 注意： UnitTest 是继承 \PHPUnit\Framework\TestCase
#        UnitTest 可以单独执行 phpunit命令测试 thinkphp 框架项目。
#        执行命令： phpunit tests/UnitTest.php


namespace tests;

use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {

        // 下面这段，是触发tp框架初始化用的...这样就可以调用Model等信息了
        require_once __DIR__ . '/../public/cli.php';

        parent::__construct($name, $data, $dataName);
    }

    public function testSomethingIsTrue()
    {
        $this->assertTrue(false);
    }

    public function testSum()
    {
        # 调用了 ThinkPHP框架 的方法
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testNum(2, 3));
    }

    public function testError()
    {
        # 调用了 ThinkPHP框架 的方法
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testError(2, 3));
    }

}