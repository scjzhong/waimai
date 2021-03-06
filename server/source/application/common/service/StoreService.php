<?php

/**
 * @author scjzhong
 * @date 2020年6月4日 下午5:29:29
 * shopservice
 */
namespace app\common\service;


use think\Db;
use app\common\model\ShopConf;
use app\common\model\Shop;
use app\common\model\Store;
use app\common\model\StoreConf;

class StoreService extends BaseService
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
    
    
    public function getBkAllStores($page, $limit)
    {
        $query = Store::field("*");
        $count = $query->count();
        if(0 == $count)
            return $this->retData(["list" => [], "count" => $count]);
        $stores = $query->order("id", "desc")->page($page, $limit)->select();
        $lists = [];
        foreach ($stores as $store){
            $lists[] = [
                "id" => $store->id,
                "name" => $store->name,
                "phone" => $store->phone,
                "status" => $store->status,
                "city" => $store->city->name,
                "addr" => $store->conf->addr,
                "cate_name" => $store->cate->name,
                "create_time" => $store->create_time
            ];
        }
        return $this->retData(["list" => $lists, "count" => $count]);
    }
    
    /**
     * 创建商家店铺的基本信息
     * @param string $name
     * @param string $phone
     * @param string $contact
     * @param string $telphone
     * @param string $addr
     * @param int $cate_id
     * @param string $status
     * @param int $rate
     * @param int $city_id
     * @return stdClass
     */
    public function createStore($name, $phone, $contact, $telphone, $addr, $cate_id, $status, $rate, $city_id)
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
        
        $phoneStore = Store::where("phone", $phone)->find();
        if(!empty($phoneStore)){
            Db::rollBack();
            return $this->retError("该手机号已存在，请更换手机号");
        }
        
        $salt = getRandomString(6);
        $store = new Store();
        $store->name         = $name;
        $store->phone        = $phone;
        $store->salt         = $salt;
        $store->password     = createPassword($store->phone, $salt);
        $store->cate_id      = $cate_id;
        $store->status       = $status == "on" ? 1 : 0;
        $store->city_id      = $city_id;
        $store->create_uid   = getAdminId();
        $store->update_time  = time();
        $store->create_time  = time();
        if(!$store->save()){
            Db::rollBack();
            return $this->retError("商家添加失败");
        }
        
        $conf = new StoreConf();
        $conf->store_id     = $store->id;
        $conf->contact      = $contact;
        $conf->telphone     = $telphone;
        $conf->addr         = $addr;
        $conf->rate         = $rate;
        $conf->update_time  = time();
        $conf->create_time  = time();
        if(!$conf->save()){
            Db::rollBack();
            return $this->retError("商家配置信息添加失败");
        }
        Db::commit();
        return $this->retSuccess("商家店铺添加成功");
    }
    
    /**
     * 修规店铺的状态
     * @param int $id
     * @return stdClass
     */
    public function updateStatus($id)
    {
        $shop = Store::find($id);
        if(empty($shop))
            return $this->retError("商家店铺不存在");
        $shop->status       = $shop->status == 1 ? 0 : 1;
        $shop->update_time  = time();
        if(!$shop->save())
            return $this->retError("修改失败");
        return $this->retSuccess("修改成功");
    }
    
    
    
    
    
    
    
}