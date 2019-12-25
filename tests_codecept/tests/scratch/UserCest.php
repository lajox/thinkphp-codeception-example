<?php

class UserCest
{
    public function _before(ScratchTester $I)
    {
    }

    /**
     * 注释
     * @param \ScratchTester  $I
     * @var \Codeception\Scenario  $scenario
     */
    public function tryToTest(ScratchTester $I, \Helper\Scratch\User $User, \Helper\Scratch\Math $Math)
    {
        // 断言测试
        $I->assertEquals(3, $Math->mathAdd(1, 2)); // 使用模块 \Helper\Scratch\Math 里的方法
        $I->assertEquals(1, $Math->mathSubtract(3, 2)); // 使用模块 \Helper\Scratch\Math 里的方法
        $I->assertEquals(date('Y-m-d'), $User->getUserCurrentDate()); // 使用模块 \Helper\Scratch\User 里的方法

        # 因为已经集成进各个模块，所以可以调用任何模块的方法， 用 $I 直接调用各个模块的方法
        # 调用方法 $I->getUserCurrentDate() 等同于 $User->getUserCurrentDate()
        $I->assertEquals(date('Y-m-d'), $I->getUserCurrentDate()); // 这里直接调用了 \Helper\Scratch\User::getUserCurrentDate() 方法
        $I->assertEquals(3, $I->mathAdd(1, 2)); // 这里直接调用了 \Helper\Scratch\Math::mathAdd() 方法

        // 场景测试
        $I->wantTo('see test page result');
        $I->amOnPage('/index/test/show');
        $I->see('show_test');
        $I->seeInCurrentUrl('/index/test/show');

        # 调用方法 seeScratchTester是自定义方法，代码在 tests/_support/ScratchTester.php 中
        $I->seeScratchTester();

        # $scenario 将会返回一个  \Codeception\Scenario 对象实例
        # getPublicScenario是自定义方法, 返回 ScratchTester::getScenario()
        # 外部不能直接调用 ScratchTester::getScenario() ，因为 getScenario()是一个 protected方法
        $scenario = $I->getPublicScenario();
        # debugSection是自定义方法，代码在 tests/_support/ScratchTester.php 中
        $I->debugSection('ScenarioHtml', $scenario->getHtml());
    }
}
