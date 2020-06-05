<?php

/**
 * @author scjzhong
 * @date 2020年6月5日 下午3:47:58
 */

namespace app\bk;
use think\Controller;
use think\Session;

class BkBase extends Controller
{
    public $allAction = [
        "passport/login"
    ];
    public function __construct()
    {
        parent::__construct();
        
        $controller = toUnderScore($this->request->controller());
        $action = $this->request->action();
        if(!in_array($controller . "/" . $action, $this->allAction)){
            if(empty(Session::get(ADMIN_ID))){
                $this->redirect("/bk/passport/login");
            }
        }
        $this->assign("adminName", Session::get(ADMIN_ID));
    }
    
    
    public function retData($data = [], $msg = '')
    {
        $data = [
            'code' => 1,
            'data' => $data,
            'msg'  => $msg
        ];
        $this->retJson($data);
    }
    
    public function retSuccess($msg = "ok")
    {
        $data = [
            'code' => 1,
            'data' => [],
            'msg'  => $msg
        ];
        $this->retJson($data);
    }
    
    public function retError($msg, $errCode = 0, $data = [])
    {
        $data = [
            'code' => $errCode,
            'msg'  => $msg,
            'data' => $data
        ];
        $this->retJson($data);
    }
    
    public function retJson($data)
    {
        //$data["data"] = !empty($data["data"]) ? base64_encode(serialize($data["data"])) : base64_encode(serialize(""));
        header('Content-Type:application/json; charset=utf-8');
        return exit(json_encode($data));
    }
    
    protected function getPage()
    {
        $page = (int)$this->request->param('page');
        return $page > 0 ? $page : 1;
    }
    
    protected function getPageLimit()
    {
        $limit = (int)$this->request->param('limit');
        return $limit > 0 && $limit <= 20 ? $limit : 10;//最多每页20条 默认10条
    }
    
    /**
     * 过滤参数
     * @param array | string $params
     * @return array | string
     */
    protected function _filter($params)
    {
        if(is_array($params)){
            foreach ($params as $key => $param) {
                $params[$key] = trim(htmlspecialchars(strip_tags($param)));
            }
            return $params;
        }elseif(is_string($params)){
            return trim(htmlspecialchars(strip_tags($params)));
        }else{
            return $params;
        }
    }
}