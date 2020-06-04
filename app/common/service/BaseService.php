<?php

/**
 * @author scjzhong
 * @date 2019年1月11日 下午3:00:09
 */

namespace app\common\service;

use think\facade\Request;

class BaseService
{
    
    /**
     * @param string $msg
     * @param array $data
     * @return \stdClass
     */
    public function retSuccess($msg = '', $data = [])
    {
        $obj = new \stdClass();
        $obj->flag = true;
        $obj->msg = $msg;
        $obj->data = $data;
        return $obj;
    }
    
    /**
     * @param string $msg
     * @param array $data
     * @return \stdClass
     */
    public function retError($msg = '', $data = [])
    {
        $obj = new \stdClass();
        $obj->flag = false;
        $obj->msg = $msg;
        $obj->data = $data;
        return $obj;
    }
    
    /**
     * 
     * @param boolean $bool
     * @param array $data
     * @return \stdClass
     */
    public function retData($data, $msg = "", $bool = true)
    {
        $obj = new \stdClass();
        $obj->flag = $bool;
        $obj->data = $data;
        $obj->msg  = $msg;
        return $obj;
    }
    
    /**
     * addQuickLog
     * @param string $operateType
     * @param string|array $beforeOperate
     * @param array|string $afterOperate
     * @param string $operateTable
     * @param string $controllerName
     */
    protected function addQuickLog($operateType, $beforeOperate, $afterOperate, $operateTable, $controllerName = "")
    {
        $logData = [
            'operate_type'      => $operateType,
            'before_operate'    => $beforeOperate,
            'after_operate'     => $afterOperate,
            'operate_table'     => $operateTable
        ];
        addQuickLog($logData, !empty($controllerName) ? $controllerName : Request::controller());
    }
}