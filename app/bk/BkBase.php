<?php

/**
 * @author scjzhong
 * @date 2019年5月25日下午9:56:36
 */

namespace app\bk;

use app\Base;
use think\facade\Session;
use think\facade\View;

class BkBase extends Base
{
    public function __construct()
    {
        parent::__construct();
        if(empty(Session::get(ADMIN_ID))){
            redirect("/bk/login/index")->send();
        }
        View::assign("adminName", Session::get(ADMIN_NAME));
    }
    
    
   
}