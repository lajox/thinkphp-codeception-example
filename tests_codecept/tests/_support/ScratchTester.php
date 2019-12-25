<?php
# 文件 tests/_support/ScratchTester.php

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class ScratchTester extends \Codeception\Actor
{
    use _generated\ScratchTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * 自定义新的测试方法
     */
    public function seeScratchTester()
    {
        # 场景测试
        $this->amOnPage('/index/test/show');
        $this->see('show_test');
        $this->seeInCurrentUrl('/index/test/show');

        # 断言测试
        $this->assertEquals(3, 1 + 2);
        $this->assertEquals(3, $this->mathAdd(1, 2)); // 使用模块 \Helper\Scratch\Math 里的方法

        # 因为unit.suite.yml已经配置了引入Db、PhpBrowser、REST等模块，
        # 所以 $this引用对象就会自动包含各个模块的所有方法

        # 使用Db模块方法, 可以查看文档： https://codeception.com/docs/modules/Db
        $this->seeNumRecords(1, 'member', ['username' => 'lajox']);

        # 使用PhpBrowser模块方法, 可以查看文档： https://codeception.com/docs/modules/PhpBrowser
        $this->sendAjaxRequest('POST', '/index/api/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);

        # 使用REST模块方法, 可以查看文档： https://codeception.com/docs/modules/REST
        $this->sendPOST('/index/api/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);

        # debug输出一条信息
        $this->debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] ScratchTester::seeScratchTester
    }

    /**
     * @return \Codeception\Scenario
     */
    public function getPublicScenario()
    {
        return $this->getScenario();
    }

    /**
     * debug
     */
    public function debugSection($title, $message)
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
