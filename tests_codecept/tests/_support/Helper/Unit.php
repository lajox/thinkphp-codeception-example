<?php
# 文件 tests/_support/Helper/Unit.php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Unit extends \Codeception\Module
{

    public function seeUnitModuleTest()
    {
        $this->getModule('\Helper\Unit\Common')->seeModuleDb(); # 测试数据库模块: Db
        $this->getModule('\Helper\Unit\Common')->seeModulePhpBrowser(); # 测试模块: PhpBrowser
        $this->getModule('\Helper\Unit\Common')->seeModuleREST(); # 测试api测试模块: REST
        $this->getModule('\Helper\Unit\Common')->seeModuleThinkPHP(); # 测试ThinkPHP模块方法
        $this->getModule('\Helper\Unit\Common')->seeModuleTest(); # 测试Test模块

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] Helper\Unit::seeUnitModuleTest
    }

}
