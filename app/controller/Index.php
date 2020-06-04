<?php
namespace app\controller;

use app\BaseController;
use think\Db;

class Index extends BaseController
{
    public function index()
    {
        echo 1;die;
        $users = Db::table("user")->select();
        var_dump($users);die;
    }
}
