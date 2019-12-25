<?php
# application/index/controller/Api.php文件

namespace app\index\controller;

class Api
{
    public function demo()
    {
        $param = input('post.');
        $data = [
            'code' => 1,
            'msg' => "success",
            'data' => $param,
        ];
        return json($data); //{"code":1,"msg":"success","data":[]}
    }
}
