<?php namespace Controller;

class ControllerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    // cmd console e.g. :
    //       codecept run unit Controller/ControllerTest
    //       codecept run unit Controller/ControllerTest --vvv
    //       codecept run unit Controller/ControllerTest::testSomeFeature
    //       codecept run unit Controller/ControllerTest::testSomeFeature --steps --debug
    public function testSomeFeature()
    {
        $this->getModule('\Helper\Unit\ThinkPHP')->seeThinkPHPIsValidate();

        $app = new \app\index\controller\Test();
        // 假设 index/test/show 方法返回的字符串中包含 "show_test"
        $this->assertContains('show_test', $app->show());

        # 调用了 ThinkPHP框架 的方法
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testNum(2, 3));

        # debug输出一条信息
        \debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] Controller\ControllerTest::testSomeFeature
    }
}