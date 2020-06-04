<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 上午10:46:17
 * 登录类
 */

namespace app\bk\controller;

use app\Base;
use think\facade\Request;
use think\facade\View;
use app\common\model\Admin;

class Login extends Base
{
    public function __construct(){
        parent::__construct();
        if(!empty(session(ADMIN_ID))){
            return $this->redirect("bk/index/index");
        }
    }
    
    public function index()
    {
        if(Request::isAjax()){
            $username = $this->_filter(Request::param("username"));
            $password = $this->_filter(Request::param("password"));
            $admin = Admin::where("username", $username)->find();
            
            if(empty($admin)){
                return $this->retError("用户名或密码错误");
            }
            
            if(!Admin::comparePassword($password, $admin->password, $admin->salt)){
                return $this->retError("用户名或密码错误");
            }
            
            session(ADMIN_ID, $admin->id);
            session(ADMIN_NAME, $admin->username);
            return $this->retSuccess("登录成功");
        }
        return View::fetch();
    }
}