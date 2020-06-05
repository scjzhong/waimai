<?php

/**
 * @author scjzhong
 * @date 2019年6月1日下午9:26:41
 * QQ:996149526
 */

namespace app\common\model;
use think\Model;

class Admin extends Model
{
    protected $pk = 'id';
    
    // 设置当前模型对应的完整数据表名称
    protected $table = 'admin';

    /**
     * 统一生成密码
     * @param string $pwd
     * @param string $salt
     * @return string
     */
    public static function createPassword(string $pwd, string $salt) :string
    {
        return md5( md5( $pwd ) . $salt );
    }
    
    
    /**
     * 登录密码对比
     * @param string $rawPwd     原始密码
     * @param string $encryptPwd 加密后的密码
     * @param string $salt       salt
     * @return bool
     */
    public static function comparePassword(string $rawPwd, string $encryptPwd, string $salt) :bool
    {
        return self::createPassword($rawPwd, $salt) === $encryptPwd;
    }
}