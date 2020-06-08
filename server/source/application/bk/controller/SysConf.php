<?php

namespace app\bk\controller;
use app\bk\BkBase;
use app\common\service\SysConfService;

class Sysconf extends BkBase
{
    public function index()
    {
        if($this->request->isAjax()){
            $ret = SysConfService::getInstance()->getAllShops(
                $this->getPage(),
                $this->getPageLimit()
            );
            return $this->retData($ret->data);
        }
        return $this->fetch();
    }
}