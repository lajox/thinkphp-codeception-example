<?php
namespace Helper\Scratch;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class User extends \Codeception\Module
{
    public function getUserCurrentDate()
    {
        $date = date('Y-m-d');
        return $date;
    }

    public function seeUserModuleDb()
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

    public function seeUserModulePhpBrowser()
    {
        // 可以查看文档： https://codeception.com/docs/modules/PhpBrowser
        # 注意： 经测试， “PhpBrowser”模块 暂时不支持POST发送JSON格式的数据, 如果要发送JSON数据请用 “REST”模块！！！

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

    public function seeUserModuleREST()
    {
        // 可以查看文档： https://codeception.com/docs/modules/REST
        // 可以查看文档： https://codeception.com/docs/10-APITesting
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

        $response = $this->getModule('REST')->grabResponse();
        $this->debugSection('response', $response); // 输出： [response] {"code":1,"msg":"success","data":{"name":"test","email":"test@163.com"}}
        $this->assertContains('success', $response);
        # debug输出一条信息
        $info = $this->getModule('REST')->grabDataFromResponseByJsonPath('$..data.email');
        $this->debugSection('info', $info); // 输出： [info] ["test@163.com"]
    }
}
