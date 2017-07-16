<?php
namespace Admin\Controller;
class TablesController extends BaseController 
{
    //搜索
    public function _empty($action='tables')
    {
        $tables = M('scoredetail');

        //搜索条件
        $search  = I('search', array());

        $s_id = $search['s_id'];
        $c_name = $search['c_name'];
        $sc_term = $search['sc_term'];
        $sc_union = $search['sc_union'];
        $sc_uploadtime = $search['sc_uploadtime'];

        if($s_id && isset($s_id)){
            $filter['s_id'] = array('like',"%{$s_id}%");
        }

        if($c_name && isset($c_name)){
            $filter['c_name'] = array('like',"%{$c_name}%");
        }

        if($sc_term && isset($sc_term)){
            $filter['sc_term'] = array('like',"%{$sc_term}%");
        }

        if($sc_union && isset($sc_union)){
            $filter['sc_union'] = array('like',"%{$sc_union}%");
        }

        if($sc_uploadtime && isset($sc_uploadtime)){
            $filter['sc_uploadtime'] = $sc_uploadtime;
        }
        
        //分页
        $total = $tables->where($filter)->count();

        if($total){
            $perNum = 30;
            $Page = new \Think\Page($total,$perNum);
            $Page->setConfig('header', '共%TOTAL_ROW%条记录&nbsp;第%NOW_PAGE%页/共%TOTAL_PAGE%页');
            $Page->setConfig('prev', "上一页");//上一页
            $Page->setConfig('next', '下一页');//下一页
            $Page->setConfig('first', '首页');//第一页
            $Page->setConfig('last', "末页");//最后一页
            $Page->setConfig( 'theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );

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

        // var_dump($sc_uploadtime);
        // dump($list);
        // exit;
        
        
        
        $pagelist = $tables->where($filter)->order('sc_term desc')->select();
        if($action == 'export'){           
            if(!$pagelist){
                $this->error('没有搜索结果，无法导出数据');
            }
            $this->export($pagelist);
        }

        if(IS_AJAX){
            $this->assign('list',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            $html = $this->fetch('Tables/tables');
            $this->ajaxReturn($html);
        }

        $this->assign('search', $search);
        $this->assign('list', $list);
        $this->assign('term',$sc_term);
        $this->assign('c_name',$c_name);
        $this->assign('union',$sc_union);
        $this->display();

    }
    
    //编辑
    public function edit()
    {
        $edit_id = I('edit_id');
        $contact = M('scoredetail');
        $result = $contact->where('id='.$edit_id)->find();
        $this->ajaxReturn($result);
    }
    //保存数据
    public function save()
    {
        $id = I('id');
        $m = M('scoredetail');
        $info = $m->where('id='.$id)->find();
        $data['s_id'] = I('s_id', '');
        $data['s_name'] = I('s_name', '');
        $data['c_name'] = I('c_name', '');
        $data['sc_number'] = I('sc_number', '');
        $data['sc_reason'] = I('sc_reason', '');
        $data['sc_time'] = I('sc_time', '');
        $data['sc_union'] = I('sc_union', '');
        $data['sc_who'] = I('sc_who', '');
        $data['sc_modifytime'] = time();
        if($info){
            //更新操作
            $result = $m->where('id='.$id)->save($data);
            if($result || $result === 0){
                $this->ajaxReturn('修改成功');
            }else if($result === FALSE){
                $this->ajaxReturn('修改失败');
            }
        }
    }

    //删除
    public function delete() 
    {
        $contact = M('scoredetail');
        $deleteArr = I('post.data');
        for($i=0;$i<count($deleteArr);$i++) {
            $contact->where('id='.$deleteArr[$i]['value'])->delete();
        }
        $this->ajaxReturn(array('message'=>'删除成功！'));
    }

    // public function deleteAll(){
    //     if(!empty($_POST['id'])){
    //         $id=$_POST['id'];
    //     }else{
    //         $id=$_GET['id'];
    //     }
    //         dump($id);
    //         //exit();
    //     if(!empty($id)){
    //         $pro=M("scoredetail"); 
    //         $data=$pro->delete($id);
    //     if($data){
    //         $this->success("删除成功!");
    //     }else{
    //         $this->error("删除失败！");
    //         }
    //     }
    // }

    //导出数据方法
    protected function export($tables_list=array())
    {
        // print_r($tables_list);exit;
        $tables_list = $tables_list;
        $data = array();
        foreach ($tables_list as $k=>$tables_info){
            $data[$k][s_id] = $tables_info['s_id'];
            $data[$k][s_name] = $tables_info['s_name'];
            $data[$k][c_name] = $tables_info['c_name'];
            $data[$k][sc_number] = $tables_info['sc_number'];
            $data[$k][sc_reason]  = $tables_info['sc_reason'];
            $data[$k][sc_time]  = $tables_info['sc_time'];
            // $data[$k][sc_who]  = $tables_info['sc_who'];
            $data[$k][sc_union] = $tables_info['sc_union'];
        }

        // print_r($tables_list);
        // print_r($data);exit;
        
        foreach ($data as $field=>$v){
            if($field == 's_id'){
                $headArr[]='学号';
            }

            if($field == 's_name'){
                $headArr[]='姓名';
            }

            if($field == 'c_name'){
                $headArr[]='班级';
            }

            if($field == 'sc_number'){
                $headArr[]='积分分数';
            }

            if($field == 'sc_reason'){
                $headArr[]='积分原因';
            }

            if($field == 'sc_time'){
                $headArr[]='时间';
            }

            // if($field == 'sc_who'){
            //     $headArr[]='记分人';
            // }
            if($field == 'sc_union'){
                $headArr[]='部室';
            }
        }

        $filename="积分汇总表";

        $this->getExcel($filename,$headArr,$data);
    }


    private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y-m-d",time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表 
        // $objPHPExcel->getActiveSheet()->setTitle('j');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$fileName);
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }

}
