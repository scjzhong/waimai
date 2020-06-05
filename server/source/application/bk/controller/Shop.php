<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 下午2:13:17
 * 商家管理
 */

namespace app\bk\controller;

use app\bk\BkBase;
use app\common\service\ShopService;
use app\common\service\CommonService;
class Shop extends BkBase
{
    public function index()
    {
        if($this->request->isAjax()){
            $ret = ShopService::getInstance()->getAllShops(
                $this->getPage(),
                $this->getPageLimit()
                );
            return $this->retData($ret->data);
        }
        return $this->fetch();
    }
    
    public function add()
    {
        if($this->request->isAjax()){
            $ret = ShopService::getInstance()->addShop();
            return $this->retData($ret->data);
        }
        $this->assign("cates", CommonService::getAllShopCate());
        $this->assign("citys", CommonService::getAllCity());
        return $this->fetch();
    }
}