<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 上午10:45:19
 */

namespace app\bk\controller;

use app\Base;
use think\facade\Session;

class Index extends Base
{
    public function index()
    {
        $res  = Session::all();
        var_dump($res);
        echo "bk";
    }
}
