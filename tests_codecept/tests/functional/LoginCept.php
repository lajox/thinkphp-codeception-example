<?php
/**
 * 注释
 * @var \FunctionalTester  $I  ( $I 将返回一个 \FunctionalTester 对象实例 )
 * @var \Codeception\Scenario  $scenario  ( $scenario 将返回一个 \Codeception\Scenario 对象实例 )
 */

$I = new FunctionalTester($scenario);
$I->amOnPage('/');
$I->click('Login');
$I->fillField('Username', 'Miles');
$I->fillField('Password', 'Davis');
$I->click('Enter');
$I->see('Hello, Miles', 'h1');
