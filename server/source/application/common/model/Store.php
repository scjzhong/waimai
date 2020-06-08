<?php
/**
 * 商家店铺
 * @author scjzhong
 * @date 2020年6月8日 上午11:46:45
 */
namespace app\common\model;
use think\Model;

class Store extends Model
{
    protected $pk = 'id';
    protected $table = 'store';
    
    /**
     * 配置
     * @return \think\model\relation\HasOne
     */
    public function conf()
    {
        return $this->hasOne("ShopConf", "shop_id", "id");
    }
    
    /**
     * 商家分类
     * @return \think\model\relation\BelongsTo
     */
    public function cate()
    {
        return $this->belongsTo("ShopCate", "cate_id", "id");
    }
    
    /**
     * 商家城市
     * @return \think\model\relation\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo("Region", "city_id", "id");
    }
}