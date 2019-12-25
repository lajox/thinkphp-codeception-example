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

        $this->specify('userName should be Lajox', function() {
            $this->setName('Check userName Correct');
            # 断言逻辑代码：
            $this->assertEquals('Lajox',  \Codeception\Util\Fixtures::get('userName'));
        });

        $this->specify("ID should be 99", function() {
            $this->setName('Check ID correct');
            # 断言逻辑代码：
            $userId = \Codeception\Util\Fixtures::get('userId');
            $this->assertEquals(99,  $userId);
        });

        $this->specify("check userName is Davert", function() {
            $this->setName('Check userName Correct');
            # 断言逻辑代码：
            \Codeception\Util\Fixtures::add('userName', 'Davert'); // userName值被改变了，由原值 Lajox 变为了 Davert
            $this->assertEquals('Davert',  \Codeception\Util\Fixtures::get('userName'));
        });

        $this->setName('Check userName equal Lajox');
        $this->assertEquals($originalUserName,  \Codeception\Util\Fixtures::get('userName'));
    }

    protected function _testFixtures()
    {
        \Codeception\Util\Fixtures::add('userName', 'Lajox');
        \Codeception\Util\Fixtures::add('userId', 99);
        \Codeception\Util\Fixtures::add('email', 'lajox@19www.com');

        $userName = \Codeception\Util\Fixtures::get('userName');
        $this->assertEquals('Lajox',  $userName);
    }
}