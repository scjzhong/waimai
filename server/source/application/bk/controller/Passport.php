<?php
/**
 * @author scjzhong
 * @date 2020年6月5日 下午4:55:01
 * bk 登录
 */
namespace app\bk\controller;
use app\bk\BkBase;
use think\Request;
use think\Session;
use app\common\model\Admin;


class Passport extends BkBase
{
    public function login()
    {
        if($this->request->isAjax()){
            
            $username = $this->_filter($this->request->param("username"));
            $password = $this->_filter($this->request->param("password"));
            $admin = Admin::where("username", $username)->find();
            
            if(empty($admin)){
                return $this->retError("用户名或密码错误");
            }
            
            if(!Admin::comparePassword($password, $admin->password, $admin->salt)){
                return $this->retError("用户名或密码错误");
            }
            
            Session::set(ADMIN_ID, $admin->id);
            Session::set(ADMIN_NAME, $admin->username);
            return $this->retSuccess("登录成功");
        }
        return $this->fetch();
    }
}