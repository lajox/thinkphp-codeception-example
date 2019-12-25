<?php
# tests/ThinkTest.php 文件
# 注意： ThinkTest 是继承 \think\testing\TestCase， 不是继承 \PHPUnit\Framework\TestCase
#        所以， php think unit 能支持 thinkphp 自身测试单元的 visit， see方法， 例如 $this->visit('/index/test/show')->see('show_test');
#        所有的 PHPUnit 的方法都支持。

namespace tests;

class ThinkTest extends \think\testing\TestCase
{
    protected $baseUrl = 'http://www.thinkapp.com';

    public function testBasicFunctions()
    {
        $app = new \app\index\controller\Test();
        // 假设 index/test/show 方法返回的字符串中包含 "show_test"
        $this->assertContains('show_test', $app->show());
    }

    public function testBasicExample()
    {
        $this->visit('/index/test/show')->see('show_test');
    }

}
