<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 下午5:29:29
 * 给后台用的shopservice
 */
namespace app\common\service;
class BkShopService extends BaseService
{
    private static $_instance;
    private function __construct(){}
    public static function getInstance()
    {
        if(!self::$_instance instanceof self){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function getAllShops()
    {
        
    }
}