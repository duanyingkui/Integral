<?php
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class TableController extends Controller
{
	
	public function index()
	{
		import("ORG.Util.AjaxPage");
		$tables = M('scoredetail');

        //搜索条件
        $search  = I('search', array());

        $c_name = $search['c_name'];
        $sc_term = $search['sc_term'];
        $sc_union = $search['sc_union'];

        if($c_name && isset($c_name)){
            $filter['c_name'] = array('like',"%{$c_name}%");
        }

        if($sc_term && isset($sc_term)){
            $filter['sc_term'] = array('like',"%{$sc_term}%");
        }

        if($sc_union && isset($sc_union)){
            $filter['sc_union'] = array('like',"%{$sc_union}%");
        }

        //分页
        $total = $tables->where($filter)->count();

        if($total){
            $perNum = 30;
            $Page = new \Think\Page($total,$perNum,"test");
            $Page->setConfig('prev', "上一页");    //上一页
            $Page->setConfig('next', '下一页');    //下一页
            $Page->setConfig('first', '首页');    //第一页
            $Page->setConfig('last', "末页");    //最后一页
            $Page->setConfig ( 'theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );

            $show = $Page->show();

            $this->assign('total',$total);
            $this->assign('page',$show);

        }

        // 班级
       $c_name = $tables->group('c_name')->order('c_name asc')->select();
        // 学期
       $sc_term = $tables->group('sc_term')->order('sc_term desc')->select();
        // 部室
       $sc_union = $tables->group('sc_union')->order('sc_union asc')->select();

       $list = $tables->where($filter)->order('sc_term desc')->limit($Page->firstRow.','.$Page->listRows)->select();
       $pagelist = $tables->where($filter)->order('sc_term desc')->select();
       
        if($action == 'export'){
            if(!$pagelist){
                $this->ajaxReturn('没有搜索结果，无法导出数据');
            }
            $this->export($pagelist);
        }

        $this->assign('search', $search);
        $this->assign('list', $list);
        $this->assign('pagelist', $pagelist); 
        $this->assign('term',$sc_term);
        $this->assign('c_name',$c_name);
        $this->assign('union',$sc_union);
        $this->display('tables');

	}
}