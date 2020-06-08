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
            $ret = ShopService::getInstance()->getBkAllShops($this->getPage(),$this->getPageLimit());
            return $this->retData($ret->data);
        }
        return $this->fetch();
    }
    
    /**
     * 创建一个商家
     * @return unknown|mixed|string
     */
    public function add()
    {
        if($this->request->isAjax()){
            $ret = ShopService::getInstance()->createShop(
                $this->_filter($this->request->param('name')),
                $this->_filter($this->request->param('phone')),
                $this->_filter($this->request->param('contact')),
                $this->_filter($this->request->param('telphone')),
                $this->_filter($this->request->param('addr')),
                $this->_filter($this->request->param('cate_id')),
                $this->_filter($this->request->param('status')),
                $this->_filter($this->request->param('rate')),
                $this->_filter($this->request->param('city_id'))
            );
            if($ret->flag)
                return $this->retSuccess($ret->msg);
            return $this->retError($ret->msg);
        }
        $this->assign("cates", CommonService::getAllShopCate());
        $this->assign("citys", CommonService::getAllCity());
        return $this->fetch();
    }
    
    public function status()
    {
        $ret = ShopService::getInstance()->updateStatus($this->_filter($this->request->param("id")));
        if(!$ret->flag)
            return $this->retError($ret->msg);
        return $this->retSuccess($ret->msg);
    }
}