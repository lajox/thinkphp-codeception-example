<?php
/*
 * 关于capabilities的文档：
 *     https://github.com/SeleniumHQ/selenium/wiki/DesiredCapabilities
 *
 * 关于WebDriver的文档：
 *     https://github.com/Codeception/Codeception/blob/3.1/docs/modules/WebDriver.md
 *     https://codeception.com/docs/modules/WebDriver#_capabilities
 *
 * 查看 chrome chromedriver 的 ChromeOptions:
 *     https://sites.google.com/a/chromium.org/chromedriver/capabilities
 *
 * 查看 firefox geckodriver 的 capabilities:
 *     https://developer.mozilla.org/en-US/docs/Web/WebDriver/Capabilities
 *     https://developer.mozilla.org/en-US/docs/Web/WebDriver/Capabilities/firefoxOptions
 *
 * 模块WebDriver的参考资料：
 *     https://codeception.com/docs/modules/WebDriver
 *
 * 多个env环境参数 来测试不同的环境 参考：
 *     https://codeception.com/docs/07-AdvancedUsage
 *
 * xpath文档资料：
 *     http://www.zvon.org/xxl/XPathTutorial/Output/
 *
 */


class ModeratorTest extends \Codeception\Test\Unit
{
    /**
     * @var \MixtureTester
     */
    protected $tester;
    
    protected function _before()
    {
//        $name = $this->getMetadata()->getName();
//        $this->getModule('WebDriver')->_capabilities(function($currentCapabilities) use ($name) {
//            $currentCapabilities['name'] = $name;
//            return $currentCapabilities;
//        });

//        $this->getModule('WebDriver')->_capabilities(function($currentCapabilities) {
//            // or new \Facebook\WebDriver\Remote\DesiredCapabilities();
//            return \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();
//        });
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function login()
    {
        // logs moderator in
    }

    /**
     * This test will be executed only in 'chrome' environments
     * you should run with command option: --env phantom
     *      `codecept run --env phantom tests\mixture\ModeratorTest.php:testMockPhantomJsBrowser`
     *      `codecept run --steps --debug --env phantom tests\mixture\ModeratorTest.php:testMockPhantomJsBrowser`
     *
     * @env phantom
     */
    public function testMockPhantomJsBrowser()
    {
        $this->assertTrue(true);

        $browser = 'phantomjs';
        $this->_runBrowserTest($browser);

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__);
    }

    /**
     * @env chrome
     */
    public function testMockChromeBrowser()
    {
        $browser = 'chrome';
        $this->_runBrowserTest($browser, []);

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__);
    }

    /**
     * @env firefox
     */
    public function testMockFirefoxBrowser()
    {
        $browser = 'firefox';
        $this->_runBrowserTest($browser, []);

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__);
    }

    protected function _runBrowserTest($browser = 'chrome', $params = [])
    {
        $config = array_merge(['browser' => $browser], (array) $params);
        $this->getModule('WebDriver')->_restart($config);
        $this->getModule('WebDriver')->_initializeSession();

        $scenario = $this->tester->getPublicScenario();
        $this->debugSection('env', $scenario->current('env'));
        $this->debugSection('browser', $scenario->current('browser'));
        //$this->debugSection('name', $scenario->current('name'));
        $this->debugSection('capabilities', $scenario->current('capabilities'));
        $modules = $scenario->current('modules');

        if ($scenario->current('browser') == 'phantomjs') {
            //$this->getModule('WebDriver')->webDriver->executeScript('window.alert = function(){return true;}');
        }

        // $webDriver = $this->getModule('WebDriver')->webDriver->getKeyboard()->sendKeys('hello, webdriver');

        $this->tester->amOnPage('/');
        $this->debugSection('_getCurrentUri', $this->getModule('WebDriver')->_getCurrentUri());
        $this->debugSection('sourceHtml', $this->getModule('WebDriver')->grabPageSource()); // 查看源代码
        $this->tester->seeInCurrentUrl('/');
        $this->tester->see('ThinkPHP');

        $this->tester->amOnUrl('http://www.baidu.com');
        $this->tester->amOnPage('/');
        $this->debugSection('_getCurrentUri', $this->getModule('WebDriver')->_getCurrentUri());
        $this->tester->see('百度');
        $this->tester->seeInSource('百度');
        $this->tester->fillField(['id' => 'kw'], $browser);
        $this->tester->click('#su'); //点击 “百度一下” 搜索按钮
        $this->tester->click('html > body'); // 再次点击 空白处， 让搜索输入下拉自动消失
        $this->debugSection('_getCurrentUri', $this->getModule('WebDriver')->_getCurrentUri());
        $this->getModule('WebDriver')->makeHtmlSnapshot('baidu');
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