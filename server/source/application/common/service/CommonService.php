<?php

/**
 * @author scjzhong
 * @date 2020年6月5日 上午9:45:45
 * 公共的service类
 */
namespace app\common\service;

use app\common\model\Region;
use app\common\model\StoreCate;

class CommonService extends BaseService
{ 
    /**
     * 获取所有的商家店铺分类
     * @return array
     */
    public static function getAllStoreCate()
    {
        return StoreCate::select();
    }
    
    /**
     * 获取所有的城市
     * @return []
     */
    public static function getAllCity()
    {
        #TODO redis 缓存
        return Region::where(["level" => 2])->select();
    }
    
    
}