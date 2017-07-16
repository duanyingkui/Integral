<?php
namespace Admin\Controller;
class ClassController extends BaseController {
    public function index(){

        $this->display();

    }
    public function input(){

    	$model=D('class');
    	if($model->create()){
           
                    if ( $model->add()) {

                       $this->success('录入成功！');
                    } else {
                       $this->error('录入失败！'); 
                    }                   
                    exit;

    	}else{
    		$this->error($model->getError());
    	}
    }
}