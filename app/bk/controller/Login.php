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
use think\facade\Session;
use think\Response;

class Login extends Base
{
    public function __construct(){
        parent::__construct();
        if(!empty(Session::get(ADMIN_ID))){
            redirect("/bk/index/index")->send();
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
            
            Session::set(ADMIN_ID, $admin->id);
            Session::set(ADMIN_NAME, $admin->username);
            return ["code" => 1, "msg" => "登录成功"];
        }
        return View::fetch();
    }
}