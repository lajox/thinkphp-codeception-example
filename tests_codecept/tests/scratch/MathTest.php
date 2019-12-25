<?php
class MathTest extends \Codeception\Test\Unit
{
    /**
     * @var \ScratchTester
     */
    protected $tester;

    protected function _inject(\Helper\Scratch\Math $math)
    {
        $this->math = $math;
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMath()
    {
        $this->assertEquals(3, $this->math->mathAdd(1, 2));
        $this->assertEquals(1, $this->math->mathSubtract(3, 2));
    }
}