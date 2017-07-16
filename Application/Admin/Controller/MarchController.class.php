<?php
namespace Admin\Controller;
use Think\Controller;
	/**
	* @Author DuanYK
	*/
class MarchController extends Controller {
	public function index()
	{
		$this->display();
	}
	public function input(){

    	$model=D('march');
    	if($model->create()){
            $model->add(I('post'));
                $this->success('录入成功！'); 
                exit;
    	}else{
    		$this->error($model->getError());
    	}
    }
    
    public function _empty($action='march')
    {
        $tables = M('march');

        //分页
        $total = $tables->where($filter)->count();

        if($total){
            $perNum = 10;
            $Page = new \Think\Page($total,$perNum);
            $Page->setConfig('prev', "上一页");//上一页
            $Page->setConfig('next', '下一页');//下一页
            $Page->setConfig('first', '首页');//第一页
            $Page->setConfig('last', "末页");//最后一页
            $Page->setConfig ( 'theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );

            $show = $Page->show();

            $this->assign('total',$total);
            $this->assign('page',$show);

        }

       $list = $tables->where($filter)->order('m_id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        if($action == 'export'){
            if(!$tables){
                $this->ajaxReturn('没有搜索结果，无法导出数据');
            }
            $this->export($tables);
        }

        $this->assign('search', $search);
        $this->assign('list', $list);
        $this->display('march');
    }
    //编辑
    public function edit()
    {
        $edit_id = I('edit_id');
        $contact = D('march');
        $result = $contact->where('m_id='.$edit_id)->find();
        $this->ajaxReturn($result);
    }
    //保存数据
    public function save()
    {
        $id = I('m_id');
        $m = D('march');
        $info = $m->where('m_id='.$id)->find();
        $data['m_id'] = I('m_id', '');
        $data['m_name'] = I('m_name', '');
        $data['m_class'] = I('m_class', '');
        $data['m_sex'] = I('m_sex', '');
        $data['m_born'] = I('m_born', '');
        $data['m_place'] = I('m_place', '');
        $data['m_address'] = I('m_address', '');
        $data['m_hobby'] = I('m_hobby', '');
        $data['m_domanial'] = I('m_domanial', '');
        $data['m_qq'] = I('m_qq', '');
        $data['m_phone'] = I('m_phone', '');
        $data['m_email'] = I('m_email', '');
        $data['m_explain'] = I('m_explain', '');
        $data['m_date'] = I('m_date', '');
        if($info){
            //更新操作
            $result = $m->where('m_id='.$id)->save($data);
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
        $contact = M('march');
        $deleteArr = I('post.data');
        for($i=0;$i<count($deleteArr);$i++) {
            $contact->where('m_id='.$deleteArr[$i]['value'])->delete();
        }
        $this->ajaxReturn(array('message'=>'删除成功！'));
    }

    //导出数据方法
    protected function export($tables_list=array())
    {
        // print_r($tables_list);exit;
        $tables_list = $tables_list;
        $data = array();
        foreach ($tables_list as $k=>$tables_info){
            $data[$k][m_id] = $tables_info['m_id'];
            $data[$k][m_name] = $tables_info['m_name'];
            $data[$k][m_class] = $tables_info['m_class'];
            $data[$k][m_sex] = $tables_info['m_sex'];
            $data[$k][m_born]  = $tables_info['m_born'];
            $data[$k][m_place]  = $tables_info['m_place'];
            $data[$k][m_address]  = $tables_info['m_address'];
            $data[$k][m_hobby] = $tables_info['m_hobby'];
            $data[$k][m_domanial] = $tables_info['m_domanial'];
            $data[$k][m_qq] = $tables_info['m_qq'];
            $data[$k][m_phone] = $tables_info['m_phone'];
            $data[$k][m_email] = $tables_info['m_email'];
            $data[$k][m_explain] = $tables_info['m_explain'];
            $data[$k][m_date] = $tables_info['m_date'];
        }

        // print_r($tables_list);
        // print_r($data);exit;
        
        foreach ($data as $field=>$v){
            if($field == 'm_id'){
                $headArr[]='学号';
            }

            if($field == 'm_name'){
                $headArr[]='姓名';
            }

            if($field == 'm_class'){
                $headArr[]='班级';
            }

            if($field == 'm_sex'){
                $headArr[]='性别';
            }

            if($field == 'm_born'){
                $headArr[]='生日';
            }

            if($field == 'm_place'){
                $headArr[]='籍贯';
            }

            if($field == 'm_address'){
                $headArr[]='现居地';
            }
            if($field == 'm_hobby'){
                $headArr[]='爱好';
            }
            if($field == 'm_domanial'){
                $headArr[]='关注的技术领域';
            }
            if($field == 'm_qq'){
                $headArr[]='QQ';
            }
            if($field == 'm_phone'){
                $headArr[]='手机号';
            }
            if($field == 'm_email'){
                $headArr[]='Email';
            }
            if($field == 'm_explain'){
                $headArr[]='个人说明';
            }
            if($field == 'm_date'){
                $headArr[]='入小组时间';
            }
        }

        $filename="三月信息统计表";

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