<?php
# tests/NewTest.php 文件
# 注意： NewTest 是继承 PHPUnit\Framework\TestCase， 不是继承 \think\testing\TestCase
#        所以， php think unit 也只能测试 普通的 单元测试方法， 像 $this->visit('/index/test/show')->see('show_test'); 这种就会提示找不到 visit方法
#        要想能支持 visit， see方法, 只能改继承父类方法： class NewTest extends \think\testing\TestCase

use PHPUnit\Framework\TestCase;

class NewTest extends TestCase
{
    #protected $baseUrl = 'http://www.thinkapp.com';

    public function testBasicFunctions()
    {
        $this->assertTrue(true);
        $this->assertEquals(2, 1 + 1);
        $app = new \app\index\controller\Test();
        // 假设 index/test/show 方法返回的字符串中包含 "show_test"
        $this->assertContains('show_test', $app->show());
    }

    public function testTest()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));
    }

    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testSum()
    {
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testNum(2, 3));
    }

    // 测试出错代码
    public function testError()
    {
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testError(2, 3));
    }

}
