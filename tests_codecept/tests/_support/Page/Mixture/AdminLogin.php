<?php
# 执行生成命令:   codecept generate:pageobject mixture AdminLogin

namespace Page\Mixture;

class AdminLogin
{
    // include url of current page
    public static $URL = '/admin/index/login.html';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    public $usernameField = 'form.layui-form input[name=username]';
    public $passwordField = 'form.layui-form input[name=password]';
    public $loginButton = 'form.layui-form button[lay-filter=login]';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @var \MixtureTester;
     */
    protected $mixtureTester;

    public function __construct(\MixtureTester $I)
    {
        $this->mixtureTester = $I;
    }

    public function login($name, $password)
    {
        $I = $this->mixtureTester;

        $I->amOnUrl('http://www.lancms.com');
        $I->amOnPage(self::$URL);
        $I->fillField($this->usernameField, $name);
        $I->fillField($this->passwordField, $password);
        $I->click($this->loginButton);
    }

}
