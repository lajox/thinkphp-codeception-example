<?php 
class MixSomeTest extends \Codeception\Test\Unit
{
    /**
     * @var \MixtureTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    // cmd console:
    //      codecept run mixture MixSomeTest::testSomeFeature --steps --debug
    public function testSomeFeature()
    {
        $this->_testSomeJson();
        $this->_testModuleWebDriver();
    }

    protected function _testSomeJson()
    {
        $jsonStr = '{"code":1,"msg":"success","data":{"name":"test","email":"test@163.com","list":[]}}';
        $email = (new \Codeception\Util\JsonArray($jsonStr))->filterByJsonPath('$.data.email'); // 注意： filterByJsonPath返回的是一个数组
        # debug输出一条信息
        \debugSection('email', $email); // 就会输出： [email] ["test@163.com"]
        $length = (new \Codeception\Util\JsonArray($jsonStr))->filterByXPath('//data/name')->length;
        # debug输出一条信息
        \debugSection('length', $length); // 就会输出： [length] 1
    }

    protected function _testModuleWebDriver()
    {
        //# $this->tester->amOnUrl('http://www.baidu.com');
        //# $this->tester->amOnPage('/index.php');
        $response =  $this->getModule('WebDriver')->amOnUrl('http://www.baidu.com');
        $this->getModule('WebDriver')->amOnPage('/index.php');
        $response =  $this->getModule('WebDriver')->grabPageSource();
        # debug输出一条信息
        \debugSection('response', $response);
    }
}