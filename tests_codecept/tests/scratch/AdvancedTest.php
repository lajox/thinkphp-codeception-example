<?php

use \Codeception\Util\Stub;

class AdvancedTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify; // 这是个 trait，库里已集成好了，可以直接 use引用进来

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
        $this->_testValidation();
        $this->_testFixtures();
    }

    protected function _testValidation()
    {
        # 更多详细用法： https://github.com/Codeception/Specify

        $originalUserName = 'Lajox';
        $originalUserId = 99;
        \Codeception\Util\Fixtures::add('userName', $originalUserName);
        \Codeception\Util\Fixtures::add('userId', $originalUserId);

        # $this->specify() 方法代码是已经集成了在 trait : \Codeception\Specify
        # 上面已经 use 引用进来了： use \Codeception\Specify
        # 所以此处可以用 $this 来直接调用。

        $this->specify('userName should be Lajox', function() {
            $this->setName('Check userName Correct');
            # debug输出值
            $this->debugSection('=== Check userName Correct ===', 'userName should be Lajox');
            $this->debugSection('userName', \Codeception\Util\Fixtures::get('userName'));
            # 断言逻辑代码：
            $this->assertEquals('Lajox',  \Codeception\Util\Fixtures::get('userName'));
        });

        $this->specify("ID should be 99", function() {
            $this->setName('Check ID correct');
            $userId = \Codeception\Util\Fixtures::get('userId');
            # debug输出值
            $this->debugSection('=== Check ID correct ===', 'ID should be 99');
            $this->debugSection('userId', $userId);
            # 断言逻辑代码：
            $this->assertEquals(99,  $userId);
        });

        $this->specify("check userName is Davert", function() {
            $this->setName('Check userName Correct');
            \Codeception\Util\Fixtures::add('userName', 'Davert'); // 这里 userName值被改变了，由原值 Lajox 变为了 Davert
            # debug输出值
            $this->debugSection('=== Check userName Correct ===', 'userName should be Davert');
            $this->debugSection('userName', \Codeception\Util\Fixtures::get('userName'));
            # 断言测试：
            $this->assertEquals('Davert',  \Codeception\Util\Fixtures::get('userName'));
        });

        $this->setName('Check userName is equal to Lajox');
        # debug输出值
        $this->debugSection('=== Check userName Correct ===', 'userName should be Lajox');
        $this->debugSection('userName', \Codeception\Util\Fixtures::get('userName'));
        # 断言测试
        $this->assertEquals($originalUserName,  \Codeception\Util\Fixtures::get('userName')); // 判断是否与原始值： Lajox 相同
    }

    protected function _testFixtures()
    {
        \Codeception\Util\Fixtures::add('userName', 'Lajox');
        \Codeception\Util\Fixtures::add('userId', 99);
        \Codeception\Util\Fixtures::add('email', 'lajox@19www.com');

        $userName = \Codeception\Util\Fixtures::get('userName');
        $this->assertEquals('Lajox',  $userName);
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