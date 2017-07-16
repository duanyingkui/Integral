<?php
namespace Admin\Controller;
class TermController extends BaseController {
    public function index(){
    	$tables = M('term');
    	$filter = "sc_term";      
        $total = $tables->where($filter)->count();
        if($total){
            $perNum = 10;
            $Page = new \Think\Page($total,$perNum);
            $Page->setConfig('prev', "上一页");//上一页
            $Page->setConfig('next', '下一页');//下一页
            $Page->setConfig('first', '首页');//第一页
            $Page->setConfig('last', "末页");//最后一页
            $Page->setConfig( 'theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
            $show = $Page->show();

            $this->assign('total',$total);
            $this->assign('page',$show);
        }
        $list = $tables->where($filter)->order('sc_term desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function addTerm(){           
    	$model = D("Term");
        if ($data = $model->create()) {
            if (false !== $model->add()) {
                $data['sc_term'] = I('sc_term');
                $this->success('添加成功');
            } else {
                $this->error('添加失败！');
            }
        } else {
            $this->error($model->getError());
        }
    }
}