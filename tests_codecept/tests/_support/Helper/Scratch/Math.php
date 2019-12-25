<?php
namespace Helper\Scratch;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Math extends \Codeception\Module
{
    public function mathAdd()
    {
        $args = func_get_args();
        return array_sum($args);
    }

    public function mathSubtract()
    {
        $args = func_get_args();
        return 2 * $args[0] - array_sum($args);
    }
}
