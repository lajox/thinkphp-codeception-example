<?php
/**
 * 注释
 * @var \AcceptanceTester  $I  ( $I 将返回一个 \AcceptanceTester 对象实例 )
 * @var \Codeception\Scenario  $scenario  ( $scenario 将返回一个 \Codeception\Scenario 对象实例 )
 */

$I = new AcceptanceTester($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/login');
$I->fillField('Username','john');
$I->fillField('Password','secret');
$I->click('Login');
$I->see('Hello john');
