<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 下午2:13:17
 * 商家管理
 */

namespace app\bk\controller;

use app\bk\BkBase;
use think\facade\Request;
use think\facade\View;
use app\common\service\BkShopService;

class Shop extends BkBase
{
    public function index()
    {
        if(Request::isAjax()){
            $ret = BkShopService::getInstance()->getAllShops(
                $this->getPage(),
                $this->getPageLimit()
            );
            return $this->retData($ret->data);
        }
        return View::fetch();
    }
}