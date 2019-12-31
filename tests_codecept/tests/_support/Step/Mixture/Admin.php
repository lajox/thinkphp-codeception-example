<?php
# 执行生成命令:   codecept generate:stepobject mixture Admin

namespace Step\Mixture;

class Admin extends \MixtureTester
{
    public function loginAsAdmin()
    {
        $I = $this;
        $I->amOnUrl('http://www.lancms.com');
        $I->amOnPage('/admin/index/login.html');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('登录');
    }
}