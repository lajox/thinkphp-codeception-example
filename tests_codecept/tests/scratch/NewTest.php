<?php

class NewTest extends \Codeception\Test\Unit
{

    /**
     * @var \ScratchTester
     */
    protected $tester;

    protected function _before()
    {

    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->getModule('PhpBrowser')->_reconfigure(array('url' => 'http://www.lancms.com'));
        $this->getModule('PhpBrowser')->sendAjaxRequest('POST', '/api/test/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);
        $this->getModule('PhpBrowser')->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        # debug输出一条信息
        $response =  $this->getModule('PhpBrowser')->grabPageSource();
        $this->debugSection('response', $response);

        $this->getModule('REST')->_reconfigure(array('url' => 'http://www.lancms.com'));
        $this->getModule('REST')->sendPOST('POST', '/api/test/demo', [
            'name' => 'test',
            'email' => 'test@163.com',
        ]);
        # debug输出一条信息
        $response =  $this->getModule('REST')->grabResponse();
        $this->debugSection('response', $response);
        # debug输出一条信息
        $info = $this->getModule('REST')->grabDataFromResponseByJsonPath('$..data.email');
        $this->debugSection('info', $info);
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