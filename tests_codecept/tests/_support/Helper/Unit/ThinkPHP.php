<?php
namespace Helper\Unit;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class ThinkPHP extends \Codeception\Module
{
    public function seeThinkPHPIsValidate()
    {
        $app = new \app\index\controller\Test();
        // 假设 index/test/show 方法返回的字符串中包含 "show_test"
        $this->assertContains('show_test', $app->show());

        # 调用了 ThinkPHP框架 的方法
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testNum(2, 3));

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] Helper\Unit\ThinkPHP::seeThinkPHPIsValidate
    }
}
