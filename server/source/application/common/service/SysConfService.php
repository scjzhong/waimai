<?php

/**
 * 系统配置
 */
namespace app\common\service;

use app\common\model\SysConf;

class SysConfService extends BaseService
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
    
    
    public function getAllConfs($page, $limit, $key)
    {
        $query = SysConf::field("*");
        if(!empty($key))
            $query->where("key", $key);
        $count = $query->count();
        if(0 == $count){
            return $this->retData(["list" => [], "count" => $count]);
        }
        $list = $query->page($page, $limit)->select();
        return $this->retData(["list" => $list, "count" => $count]);
    }
}