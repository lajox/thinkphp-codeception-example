<?php
class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \ScratchTester
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
        # 断言测试
        $this->assertTrue(true);
        # 调用自定义方法
        $this->_testHelperScratch();    # 测试业务代码: tests/_support/Helper/Scratch.php
    }

    /**
     * 测试业务代码放入 tests/_support/Helper/Scratch.php 文件中
     */
    protected function _testHelperScratch()
    {
        # 断言测试
        $this->assertTrue(true);
        $this->assertEquals(3, 1 + 2);
        $this->assertEquals(3, $this->getModule('\Helper\Scratch\Math')->mathAdd(1, 2));

        # 因为unit.suite.yml已经配置了引入Db、PhpBrowser、REST等模块，
        # 所以 $this->tester引用对象就会自动包含各个模块的所有方法。可以用 $this->tester 简化替代 $this->getModule() 方法。

        # 调用模块 \Helper\Scratch 里的方法
        $this->getModule('\Helper\Scratch')->seeScratchModuleTest();
        $this->tester->seeScratchModuleTest();

        # 调用模块 Db 里的方法
        $this->getModule('Db')->seeInDatabase('member', ['username' => 'lajox', 'email like' => '%yeah.net%']);
        $this->tester->seeInDatabase('member', ['username' => 'lajox', 'email like' => '%yeah.net%']);

        # 调用模块 PhpBrowser 里的方法
        $this->getModule('PhpBrowser')->sendAjaxPostRequest('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);
        $this->tester->sendAjaxPostRequest('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);

        # 调用模块 REST 里的方法
        $this->getModule('REST')->sendPOST('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);
        $this->tester->sendPOST('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);


        # 场景测试
        $this->_testCept();

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] UserTest::_testHelperScratch
    }

    /**
     * 测试场景
     * @var \ScratchTester $this->tester
     */
    protected function _testCept()
    {
        $this->tester->amOnPage('/index/test/show');
        $this->tester->see('show_test');
        $this->tester->seeInCurrentUrl('/index/test/show');

        # 可以将场景测试代码移入文件 tests/_support/ScratchTester.php 中
        $this->tester->seeScratchTester();
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