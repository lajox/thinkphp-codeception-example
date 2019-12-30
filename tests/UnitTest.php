<?php
# tests/UnitTest.php 文件
# cmd console:
#     phpunit tests/UnitTest.php
# 注意： UnitTest 是继承 \PHPUnit\Framework\TestCase， 并不是继承 \think\testing\TestCase
#        UnitTest 可以单独执行phpunit命令。
#        因为引入了 public/cli.php 的thinkphp启动文件， 所以 UnitTest可以测试 thinkphp 框架项目里的方法。

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
        # 调用了ThinkPHP框架的方法, 测试语法是不是错误
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testError(2, 3));
    }

}