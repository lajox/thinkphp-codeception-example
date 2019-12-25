<?php
# 文件 tests/_support/Helper/Scratch.php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Scratch extends \Codeception\Module
{
    public function seeScratchModuleTest()
    {
        # 测试模块: \Helper\Scratch\Math
        $this->assertEquals(3, $this->getModule('\Helper\Scratch\Math')->mathAdd(1, 2));

        # 测试模块: \Helper\Scratch\User
        $this->assertEquals(date('Y-m-d'), $this->getModule('\Helper\Scratch\User')->getUserCurrentDate());
        $this->getModule('\Helper\Scratch\User')->seeUserModuleDb();
        $this->getModule('\Helper\Scratch\User')->seeUserModulePhpBrowser();
        $this->getModule('\Helper\Scratch\User')->seeUserModuleREST();

        # 测试模块: Db
        $this->getModule('Db')->seeInDatabase('member', ['username' => 'lajox', 'email like' => '%yeah.net%']);

        # 调用模块 PhpBrowser 里的方法
        $this->getModule('PhpBrowser')->sendAjaxRequest('POST', '/index/api/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);

        # 调用模块 REST 里的方法
        $this->getModule('REST')->sendPOST('/index/api/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] Helper\Scratch::seeScratchModuleTest
    }
}
