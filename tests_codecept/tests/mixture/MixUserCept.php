<?php 
$I = new MixtureTester($scenario);
//$I->wantTo('perform actions and see result');

function _debugScenario($I, $scenario)
{
    // retrieve current environment
    $env = $scenario->current('env');
    $I->debugSection('env', $env);

    // list of all enabled modules
    $modules = $scenario->current('modules');
    $I->debugSection('modules', $modules);

    // test name
    $name = $scenario->current('name');
    $I->debugSection('name', $name);

    // browser name (if WebDriver module enabled)
    $browser = $scenario->current('browser');
    $I->debugSection('browser', $browser);

    // capabilities (if WebDriver module enabled)
    $capabilities = $scenario->current('capabilities');
    $I->debugSection('capabilities', $capabilities);
}
_debugScenario($I, $scenario);

$I->amOnPage('/index/test/show');
$I->see('show_test');

$I->wantTo('log in as regular user');
$I->amOnUrl('http://www.lancms.com');
$I->amOnPage('/admin/index/login.html');
$I->fillField('username','admin');
$I->fillField('password','123456');
$I->click('登录');
$I->wait(3);
$I->see('LanCMS后台');
