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