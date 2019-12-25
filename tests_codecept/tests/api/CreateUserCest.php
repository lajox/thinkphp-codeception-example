<?php 

class CreateUserCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    // tests
    public function createUserViaAPI(\ApiTester $I)
    {
        # 发送请求api地址： http://www.thinkapp.com/index/api/demo
        # 请求参数： {"name":"test","email":"test@163.com"}
        # 响应结果： {"code":1,"msg":"success","data":[]}
        $I->haveHttpHeader('accept', 'application/json');
        // $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded'); // 普通表单形式发送
        $I->haveHttpHeader('content-type', 'application/json'); // 发送JSON形式数据
        $I->sendPOST('/index/api/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('success');
        $I->seeResponseContainsJson([
            "code" => "1",
        ]);
        $I->seeResponseJsonMatchesJsonPath("$.data");
        $I->seeResponseJsonMatchesXpath('//data');
        $I->seeResponseMatchesJsonType([
            'code' => 'integer',
            'msg' => 'string',
            'data' => 'string|array|null',
        ]);

    }
}
