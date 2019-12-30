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

    $I->debugSection('scenario', $scenario->getSteps());
}
_debugScenario($I, $scenario);

$I->amOnPage('/index/test/show');
$I->see('show_test');

$I->wantTo('log in as regular user');
$I->amOnUrl('http://www.lancms.com');
$I->amOnPage('/admin/index/login.html');
$I->fillField('username','admin');
$I->fillField('password','admin');

/*
 * xpath文档资料：
 *      http://www.zvon.org/xxl/XPathTutorial/Output/
 *
 * Locator资料参考:
 *      https://www.w3cschool.cn/doc_codeception/codeception-reference-locator.html?lang=en
 *
 *
 * login page source:
 *     <form class="layui-form" action="/admin/index/login.html">
 *     	<div class="layui-form-item">
 *     		<div class="layui-input-inline input-item">
 *     			<label for="username">用户名</label>
 *     			<input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="账号" class="layui-input">
 *     		</div>
 *     		<div class="layui-input-inline input-item">
 *     			<label for="password">密码</label>
 *     			<input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="密码" class="layui-input">
 *     		</div>
 *     		<div class="layui-input-inline login-btn">
 *     			<button class="layui-btn" lay-filter="login" lay-submit>登录</button>
 *     		</div>
 *     	</div>
 *     </form>
 *
 */

$I->click('登录');

// CSS selector applied
//$I->click('.login-btn button[lay-submit]');

// XPath
//$I->click('//button[@lay-submit]');
// Using context as second argument
//$I->click('登录', '.login-btn');
//$I->click('登录' , \Codeception\Util\Locator::elementAt("//form//div[contains(@class, 'login-btn')]", 1));
//$I->click('登录' , \Codeception\Util\Locator::elementAt("//div[contains(@class, 'login-btn')]", 1));
//$I->click('登录' , \Codeception\Util\Locator::find('form', ['class' => 'layui-form']));
//$I->click('登录' , \Codeception\Util\Locator::contains("//form[@class='layui-form']", '用户名'));
//$I->click('登录' , \Codeception\Util\Locator::elementAt("//form[@class='layui-form']", 1));
//$I->click( \Codeception\Util\Locator::elementAt("//button[@lay-filter='login']", 1) );
//$I->click( \Codeception\Util\Locator::elementAt("//button[@lay-submit]", 1) );

//$button = \Facebook\WebDriver\WebDriverBy::xpath('//button[@lay-submit]');
//$I->submitForm('.layui-form', array('username' => 'admin', 'password' => 'admin'), $button);
//$I->seeInFormFields("//form[@class='layui-form']", array('username' => 'admin', 'password' => 'admin'));
//$I->seeInField('username', 'admin');

$I->wait(3);
$I->seeInTitle('LANCMS后台管理系统');
$I->see('LanCMS后台');
$I->seeInCurrentUrl('/admin/index/index.html');

