<?php
/**
 * 注释
 * @var \ScratchTester  $I  ( $I 将返回一个 \ScratchTester 对象实例 )
 * @var \Codeception\Scenario  $scenario  ( $scenario 将返回一个 \Codeception\Scenario 对象实例 )
 */
$I = new ScratchTester($scenario);
$I->wantTo('see test page result');
$I->amOnPage('/index/test/show');
$I->see('show_test');
$I->seeInCurrentUrl('/index/test/show');

# 断言测试
$I->assertEquals(3, 1 + 2);
$I->assertEquals(3, $I->mathAdd(1, 2)); // 调用 mathAdd方法在模块 Helper\Scratch\Math 里定义

# 调用方法 seeScratchTester是自定义方法，代码在 tests/_support/ScratchTester.php 中
$I->seeScratchTester();

# debugSection是自定义方法，代码在 tests/_support/ScratchTester.php 中
$I->debugSection('ScenarioHtml', $scenario->getHtml());