<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 下午5:29:29
 * shopservice
 */
namespace app\common\service;

use app\bk\controller\Shop;
use think\Db;
use app\common\model\ShopConf;

class ShopService extends BaseService
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
    
    
    public function getBkAllShops()
    {
            
    }
    
    public function createShop($name, $phone, $contact, $telphone, $addr, $cate_id, $status, $rate, $city_id)
    {
        if(empty($name))
            return $this->retError("请输入店铺名称");
        if(!is_phone($phone))
            return $this->retError("手机号不正确");
        if(empty($contact))
            return $this->retError("商家联系人不能为空");
        if(empty($telphone))
            return $this->retError("商家联系电话不能为空");
        if(empty($addr))
            return $this->retError("商家地址不能为空");
        if(empty($cate_id))
            return $this->retError("商家分类不能为空");
        if(!in_array($status, ['on', 'off']))
            return $this->retError("商家分类不能为空");
        if($rate < 0 || $rate > 20){
            return $this->retError("抽成比例需在 0-20%之间");
        }
        
        Db::startTrans();
        $shop = new \app\common\model\Shop();
        $shop->name         = $name;
        $shop->cate_id      = $cate_id;
        $shop->status       = $status == "on" ? 1 : 0;
        $shop->city_id      = $city_id;
        $shop->create_uid   = getAdminId();
        $shop->update_time  = date("Y-m-d H:i:s");
        $shop->create_time  = date("Y-m-d H:i:s");
        if(!$shop->save()){
            Db::rollBack();
            return $this->retError("商家添加失败");
        }
        
        $phoneConf = ShopConf::where("phone", $phone)->find();
        if(!empty($phoneConf)){
            Db::rollBack();
            return $this->retError("该手机号已存在，请更换手机号");
        }
        
        $conf = new ShopConf();
        $conf->shop_id      = $shop->id;
        $conf->phone        = $phone;
        $conf->contact      = $contact;
        $conf->telphone     = $telphone;
        $conf->addr         = $addr;
        $conf->rate         = $rate;
        $conf->update_time  = date("Y-m-d H:i:s");
        $conf->create_time  = date("Y-m-d H:i:s");
        if(!$conf->save()){
            Db::rollBack();
            return $this->retError("商家配置信息添加失败");
        }
        Db::commit();
        return $this->retSuccess("商家店铺添加成功");
    }
}