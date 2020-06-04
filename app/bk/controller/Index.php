<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 上午10:45:19
 */

namespace app\bk\controller;


use app\bk\BkBase;
use think\facade\View;

class Index extends BkBase
{
    public function index()
    {
        
        return View::fetch();
    }
    
    public function home()
    {
        echo time();
    }
}
