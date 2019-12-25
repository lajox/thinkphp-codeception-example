<?php
# application/index/controller/Test.php文件

namespace app\index\controller;

class Test
{
    public function testNum($a, $b)
    {
        $c = $a * $b;
        return $c;
    }

    public function testError($a, $b)
    {
        $c = $a * $b;
        return $z; // 故意写错成 $z
    }

    public function show()
    {
        return 'show_test';
    }
}
