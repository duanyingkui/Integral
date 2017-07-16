<?php
namespace Admin\Controller;

class EmptyController extends BaseController{
    public function index(){
        //根据当前控制器名来判断要执行那个城市的操作
        $this->display('Base/404');
    }

}