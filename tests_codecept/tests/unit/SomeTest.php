<?php
# 文件 tests/unit/SomeTest.php
class SomeTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->assertTrue(true);

        $this->_testDB();          # 测试数据库模块: Db
        $this->_testPhpBrowser();  # 测试模块: PhpBrowser
        $this->_testREST();        # 测试api测试模块: REST
        $this->_testCept();        # 场景测试
        $this->_testScratch();     # 综合测试，混用
        $this->_testThinPHP();     # 测试ThinkPHP 5.1方法
    }

    protected function _testDB()
    {
        // 可以查看文档： https://codeception.com/docs/modules/Db
        $dbh = $this->getModule('Db')->_getDbh(); // dbh: contains the PDO connection 返回一个PDO连接对象
        // $dbh是一个PDO对象，就可以说使用任何PDO对象的方法 （https://www.php.net/manual/en/class.pdo.php）
        $sql = "SELECT username, email FROM `member` where username = 'lajox' ORDER BY id";
        // 比如使用PDO::query()方法
        foreach ($dbh->query($sql) as $row) {
            $this->assertContains('lajox', $row['username']); // $row['username']变量值是否包含字符串lajox
            $this->assertContains('blueno@yeah.net', $row['email']); // $row['email']变量值是否包含字符串blueno@yeah.net
        }

        $this->getModule('Db')->seeNumRecords(1, 'member', ['username' => 'lajox']); // 判断member表里username='lajox'的数据记录数是不是1(条)
        $this->getModule('Db')->seeInDatabase('member', ['username' => 'lajox', 'email like' => '%yeah.net%']); // 判断member表里username='lajox' AND email like '%yeah.net%'是否存在记录
        $this->getModule('Db')->dontSeeInDatabase('member', ['email like' => '%163.com%']); // 判断member表里email like '%163.com%'是否不存在记录

        $number = $this->getModule('Db')->grabNumRecords('member', ['username' => 'lajox']); // 获取member表里username='lajox'的记录数
        $mails = $this->getModule('Db')->grabColumnFromDatabase('member', 'email', array('username' => 'lajox')); // 获取member表里username='lajox'的邮箱字段email的数组列表
        $email = $this->getModule('Db')->grabFromDatabase('member', 'email', ['email like' => '%blueno%']); // 获取member表里email like '%blueno%'的数据列表（数组）

        $this->debugSection('number', $number);
        $this->debugSection('MailList', $mails);
        $this->debugSection('Email', $email);
    }

    protected function _testPhpBrowser()
    {
        // 可以查看文档： https://codeception.com/docs/modules/PhpBrowser
        $this->getModule('PhpBrowser')->haveHttpHeader('accept', 'application/json');
        // $this->getModule('PhpBrowser')->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded'); // 普通表单形式发送
        $this->getModule('PhpBrowser')->haveHttpHeader('content-type', 'application/json'); // 发送JSON形式数据
        // AJAX请求
        //$this->getModule('PhpBrowser')->sendAjaxPostRequest('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);
        $this->getModule('PhpBrowser')->sendAjaxRequest('POST', '/index/api/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);
        $this->getModule('PhpBrowser')->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        # debug输出一条信息
        $response =  $this->getModule('PhpBrowser')->grabPageSource();
        $this->debugSection('response', $response);
    }

    protected function _testREST()
    {
        # 发送请求api地址： http://www.thinkapp.com/index/api/demo
        # 请求参数： {"name":"test","email":"test@163.com"}
        # 响应结果： {"code":1,"msg":"success","data":[]}
        $this->getModule('REST')->haveHttpHeader('accept', 'application/json');
        // $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded'); // 普通表单形式发送
        $this->getModule('REST')->haveHttpHeader('content-type', 'application/json'); // 发送JSON形式数据
        $this->getModule('REST')->sendPOST('/index/api/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);
        $this->getModule('REST')->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $this->getModule('REST')->seeResponseCodeIs(200);
        $this->getModule('REST')->seeResponseIsJson();
        $this->getModule('REST')->seeResponseContains('success');
        $this->getModule('REST')->seeResponseContainsJson([
            "code" => "1",
        ]);
        $this->getModule('REST')->seeResponseJsonMatchesJsonPath("$.data");
        $this->getModule('REST')->seeResponseJsonMatchesXpath('//data');
        $this->getModule('REST')->seeResponseMatchesJsonType([
            'code' => 'integer',
            'msg' => 'string',
            'data' => 'string|array|null',
        ]);
    }

    /**
     * 测试场景
     * @var \UnitTester $this->tester
     */
    protected function _testCept()
    {
        $this->tester->amOnPage('/index/test/show');
        $this->tester->see('show_test');
    }

    /**
     * 综合测试，混用
     * @var \UnitTester $this->tester
     */
    protected function _testScratch()
    {
        # 因为unit.suite.yml已经配置了引入Db、PhpBrowser、REST等模块，
        # 所以 $this->tester引用对象就会自动包含各个模块的所有方法。可以用 $this->tester 简化替代 $this->getModule() 方法。

        # 模块Db方法：
        $this->getModule('Db')->seeNumRecords(1, 'member', ['username' => 'lajox']);
        $this->tester->seeNumRecords(1, 'member', ['username' => 'lajox']);

        # 模块PhpBrowser方法：
        $this->getModule('PhpBrowser')->sendAjaxPostRequest('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);
        $this->tester->sendAjaxPostRequest('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);

        # 模块REST方法：
        $this->getModule('REST')->sendPOST('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);
        $this->tester->sendPOST('/index/api/demo', ['name' => 'test', 'email' => 'test@163.com']);
    }

    /**
     * 测试ThinkPHP的方法
     */
    protected function _testThinPHP()
    {
        $app = new \app\index\controller\Test();
        // 假设 index/test/show 方法返回的字符串中包含 "show_test"
        $this->assertContains('show_test', $app->show());
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