<?php
# 文件 tests/unit/ExampleTest.php
class ExampleTest extends \Codeception\Test\Unit
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
    public function testSomeFeature()
    {
        $this->assertTrue(true);

        $this->_testHelperUnit();    # 测试业务代码: tests/_support/Helper/Unit.php
    }

    /**
     * 测试业务代码放入 tests/_support/Helper/Unit.php 文件中
     */
    protected function _testHelperUnit()
    {
        # 调用模块 \Helper\Unit 里的方法
        $this->getModule('\Helper\Unit')->seeUnitModuleTest();
        $this->tester->seeUnitModuleTest();

        # 场景测试
        $this->_testCept();

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] ExampleTest::_testHelperUnit
    }

    /**
     * 测试场景
     * @var \UnitTester $this->tester
     */
    protected function _testCept()
    {
        $this->tester->amOnPage('/index/test/show');
        $this->tester->see('show_test');
        # 可以将场景测试代码移入文件 tests/_support/UnitTester.php 中
        $this->tester->seeUnitTester();
    }

    /**
     * debug
     */
    protected function debugSection($title, $message)
    {
        if (is_object($message)) {
            try {
                $message = var_export($message, true);
            } catch (\Exception $exception) {
                $message = print_r($message, true);
            }
        } else if(is_array($message)) {
            $message = stripslashes(json_encode($message));
        } else if(is_bool($message) || is_null($message)) {
            $message = json_encode($message);
        }
        \codecept_debug("[$title] $message");
    }

}