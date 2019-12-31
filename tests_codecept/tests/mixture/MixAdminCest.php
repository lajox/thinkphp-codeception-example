<?php 

class MixAdminCest
{
    public function _before(MixtureTester $I)
    {
    }

    // tests
    public function tryToTest(MixtureTester $I)
    {
    }

    public function adminLogin(\Step\Mixture\Admin $I)
    {
        $I->loginAsAdmin();
        $I->wait(3);
        $I->amOnPage('/admin/index/index.html');
        $I->seeInTitle('LANCMS后台管理系统');
        $I->see('LanCMS后台', '.logo');
    }

    public function adminLoginAgain(MixtureTester $I, \Page\Mixture\AdminLogin $loginPage)
    {
        $loginPage->login('admin', 'admin');
        $I->wait(3);
        $I->amOnPage('/admin/index/index.html');
        $I->seeInTitle('LANCMS后台管理系统');
        $I->see('LanCMS后台', '.logo');
    }
}
