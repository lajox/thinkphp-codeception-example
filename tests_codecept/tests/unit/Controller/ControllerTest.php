<?php namespace Controller;

class ControllerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    // cmd console e.g. :
    //       codecept run unit Controller/ControllerTest
    //       codecept run unit Controller/ControllerTest --vvv
    //       codecept run unit Controller/ControllerTest::testSomeFeature
    //       codecept run unit Controller/ControllerTest::testSomeFeature --steps --debug
    public function testSomeFeature()
    {
        $this->getModule('\Helper\Unit\ThinkPHP')->seeThinkPHPIsValidate();

        $this->testThinkMethod();

        # debug输出一条信息
        \debugSection('CurrentMethod', __METHOD__); // 就会输出： [CurrentMethod] Controller\ControllerTest::testSomeFeature

        $this->testRequestAPI();
    }

    protected function testThinkMethod()
    {
        $app = new \app\index\controller\Test();
        // 假设 index/test/show 方法返回的字符串中包含 "show_test"
        $this->assertContains('show_test', $app->show());

        # 调用了 ThinkPHP框架 的方法
        $obj = new \app\index\controller\Test();
        $this->assertEquals(6, $obj->testNum(2, 3));
    }

    protected function testRequestAPI()
    {
        # 测试登陆接口逻辑
        $this->_testLoginProcess();
        # 测试 member接口
        $this->_testMemberProcess();
    }

    protected function _testLoginProcess()
    {
        # 登陆接口逻辑操作
        // $this->getModule('REST')->haveHttpHeader('accept', 'application/json');
        // $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded'); // 普通表单形式发送
        $this->getModule('REST')->haveHttpHeader('content-type', 'application/json'); // 发送JSON形式数据
        $this->getModule('REST')->haveHttpHeader('X-Requested-With', 'XMLHttpRequest'); // 表示ajax请求
        $this->getModule('REST')->sendPOST('http://www.lancms.com/admin/index/login.html', [
            'username' => 'admin',
            'password' => 'admin',
        ]);
        $this->getModule('REST')->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $this->getModule('REST')->seeResponseIsJson();
        $this->getModule('REST')->seeResponseContains('登陆成功');
        $this->getModule('REST')->seeResponseJsonMatchesJsonPath("$.data");
        $this->getModule('REST')->seeResponseJsonMatchesXpath('//data');
        $this->getModule('REST')->seeResponseMatchesJsonType([
            'code' => 'integer',
            'msg' => 'string',
            'data' => 'string|array|null',
        ]);
        # debug输出一条信息
        $response =  $this->getModule('REST')->grabResponse();
        \debugSection('response', $response); // 输出： [response] {"code":1,"msg":"恭喜您，登陆成功","data":"","url":"/admin/index/index.html","wait":3}
        # debug输出一条信息
        $info = $this->getModule('REST')->grabDataFromResponseByJsonPath('$.code');
        \debugSection('info', $info); // 输出： [info] [1]
        $this->tester->assertEquals(1, $info[0]); //断言
        $this->assertEquals(1, $info[0]); //断言
    }

    protected function _testMemberProcess() {
        # 测试member接口
        $this->getModule('REST')->haveHttpHeader('content-type', 'application/json'); // 发送JSON形式数据
        $this->getModule('REST')->haveHttpHeader('X-Requested-With', 'XMLHttpRequest'); // 表示ajax请求
        $this->getModule('REST')->sendGET('http://www.lancms.com/member/member/manage.html', [
            'page' => 1,
            'limit' => 10,
            'search_field' => 'username',
            'keyword' => 'lajox'
        ]);
        $response =  $this->getModule('REST')->grabResponse();
        \debugSection('response', $response); // 输出： [response] {"code":1,"msg":"success","data":[{"id":1,"username":"lajox","email":"blueno@yeah.net","status":1}],"count":1}
    }
}