<?php

namespace app\store\controller;

use think\Session;
use app\common\model\Store;

/**
 * 商户认证
 * Class Passport
 * @package app\store\controller
 */
class Passport extends Controller
{
    /**
     * 商户后台登录
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login()
    {
        if ($this->request->isAjax()) {
            $data = $this->postData('User');
            $store = Store::where("phone", $data["user_name"])->find();
            if(empty($store) || !comparePassword($data["password"], $store->password, $store->salt)){
                return $this->renderError("用户名或密码错误");
            }
            
            Session::set('store', [
                'user' => [
                    'id' => $store['id'],
                    'phone' => $store['phone'],
                ],
                'is_login' => true,
            ]);
            
            return $this->renderSuccess('登录成功', url('index/index'));
        }
        $this->view->engine->layout(false);
        return $this->fetch('login');
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::clear('store');
        $this->redirect('passport/login');
    }

}
