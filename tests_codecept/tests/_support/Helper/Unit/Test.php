<?php
namespace Helper\Unit;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Test extends \Codeception\Module
{
    public function seeTestModuleIsValidate()
    {
        $this->assertTrue(true);
    }
}
