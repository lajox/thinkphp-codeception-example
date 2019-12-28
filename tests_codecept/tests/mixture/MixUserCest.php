<?php 

class MixUserCest
{
    public function _before(MixtureTester $I)
    {
    }

    // tests
    /**
     * This test will be executed only in 'firefox' and 'phantom' environments
     *
     * @env firefox
     * @env phantom
     */
    public function tryWebkitOnlyTest(\MixtureTester $I)
    {
        $this->_debugScenario($I);

        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
    }

    public function tryToTest(MixtureTester $I)
    {
    }

    public function myTest(\MixtureTester $I, \Codeception\Scenario $scenario, \Helper\Mixture $mixture, \Codeception\Suite $suite)
    {
        $I->debugSection('browser', $scenario->current('browser'));

        if ($scenario->current('browser') == 'phantomjs') {
            // emulate popups for PhantomJS
            //$I->debugSection('module', $mixture->getPublicModule('WebDriver'));
            //$mixture->getPublicModule('WebDriver')->webDriver->executeScript('window.alert = function(){return true;}');
        }

        $I->assertTrue(true);

        $I->amOnPage('/index/test/show');
        $I->see('show_test');
    }

    protected function _debugScenario(MixtureTester $I)
    {
        $scenario = $I->getPublicScenario();

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
}
