<?php
# tests/ExampleTest.php 文件
# cmd console:
#     php think unit tests/ExampleTest.php

namespace tests;

class ExampleTest extends TestCase
{

    public function testBasicExample()
    {
        $this->visit('/')->see('ThinkPHP');
    }
}