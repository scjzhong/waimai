<?php

/**
 * @author scjzhong
 * @date 2020年6月5日 下午3:48:04
 */

namespace app\bk\controller;
use app\bk\BkBase;

class Index extends BkBase
{
    public function index()
    {
        return $this->fetch();
    }
}