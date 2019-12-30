<?php
# tests/NewTest.php 文件
# cmd console:
#     phpunit tests/NewTest.php

namespace tests;

//# require_once __DIR__ . '/_bootstrap.php';

use PHPUnit\Framework\TestCase;

class NewTest extends TestCase
{

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        require_once __DIR__ . '/_bootstrap.php';

        parent::__construct($name, $data, $dataName);
    }

    public function testBasicFunctions()
    {
        $this->assertTrue(true);
        $this->assertEquals(2, 1 + 1);
    }

    public function testThinkFunctions()
    {
        $app = new \app\index\controller\Test();
        // 假设 index/test/show 方法返回的字符串中包含 "show_test"
        $this->assertContains('show_test', $app->show());
    }

}
