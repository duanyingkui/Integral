<?php
/**
 * Created by PhpStorm.
 * User: feifei
 * Date: 16/10/7
 * Time: 上午11:13
 */

namespace Admin\Controller;
use Think\Controller;
class ManageController extends  BaseController
{
    function __construct(){
        parent::__construct();
    }
    /*
        空方法的判断
    */
    function _empty($name){
        // $is_exist = $this->student_is_exist($name);
        // var_dump($is_exist);
        // if ($is_exist) {
        //     echo("存在");
        // }else{
        //     echo("不存在");
        // }
        // exit();
        $this->redirect('member');
    }
    /*
        判断这个学生是否存在于数据库中
    */
    public function student_is_exist($student_id){

        if (is_numeric($student_id) && !is_null($student_id) && !empty($student_id)) {
            $modal = M('student');
            if ($modal) {
                $select_rlst = $modal->where('s_id='.'"'.$student_id.'"')->select();
                if ($select_rlst) {
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    function member(){
        
        $data    = D('Office');
        $current = $_SESSION['o_id'];
        $list    = $data->where('o_id not like '.$current)->select();

        $this->assign('list',$list);
        $this->display();
    }
    
    function get_studentinfo_by_id(){
        if (!empty($_POST)) {
            $modal = M('student');
            $id = $_POST['s_id'];
            if ($modal) {
                $select_rlst = $modal->where('s_id='.'"'.$id.'"')->select();
                if ($select_rlst) {
                    $name = $select_rlst[0]['s_name'];
                    echo($name);
                }
            }
        }
    }

    function delete(){
        $off_mdl = D('Office');
        $arr     = array();
        $err_arr = array();

        if($_POST != null){
            $arr = array_values($_POST);

            if($arr != null){
                for($i = 0;$i < count($arr);$i++){
                    $bo = $off_mdl->where('o_id='.'"'.$arr[$i].'"')->delete();
                    if(!$bo){
                        array_push($err_arr,$arr[$i]);
                    }

                }
            }
        }
        $_POST = array();
        if($err_arr){
            exit(0);
        }
        $data = $this->get_HTML();
        echo $data;

    }

    function add(){
        $data = D('Office');
        if($_POST['s_id'] && $_POST['s_name']){

            $insert = Array();
            $insert['o_id']      =    $_POST['s_id'];
            $insert['o_name']    =    $_POST['s_name'];
            $insert['o_psd']     =    md5('123456');
            $insert['o_ispower'] =    0;
            
            if ($this->student_is_exist($_POST['s_id'])) {
                $bo  = $data->add($insert);
                $rtn = array();
                if($bo){
                    $data          = $this->get_HTML();
                    $rtn['status'] = 1;
                    $rtn['data']   = $data;
                }else{
                    $rtn['status'] = 0;
                    $rtn['warn']   = STUDENT_NUM_EXISTED;
                }
            } else {
                $rtn['status'] = 0;
                $rtn['warn']   = STUDENT_UNEXIST;
            }
        }else{
            $rtn['status'] = 0;
            $rtn['warn']   = ONE_CONTENT_NULL_WARNING;
        }

        $_POST = array();
        echo json_encode($rtn);
    }
    function  modify_psd(){

        if(!$this->verify($_POST['psd'],$_POST['psd_again'])){
            exit;
        }

        $off_mdl = M('Office');
        $id      = $_POST['id'];
        $psd     = md5($_POST['psd']);

        $data['o_psd'] = $psd;
        $bo            = $off_mdl->where('o_id='.$id)->save($data);

        if($bo === false){
            echo(FAIL);
            return;

        }else{
            echo(SUCCESS);
            return;
        }
    }
    function  verify($psd,$psd_again){
        if($psd == "" && $psd_again == ""){
            echo DOUBLE_CONTENT_NULL_WARNING;
            return false;
        }
        if($psd == "" || $psd_again == ""){
            echo ONE_CONTENT_NULL_WARNING;
            return false;
        }
        if($psd != $psd_again){
            echo TOW_CONTENT_UNEQUAL_WARNING;
            return false;
        }
        return true;
    }
    
    function get_HTML(){
        $list    = array();
        $off_mdl = D('Office');
        $list    = $off_mdl->where('o_id not like '.$_SESSION['o_id'])->select();
        $data    = '';
        if(!empty($list)){
            foreach($list as $v){
                $data = $data.'<tr id="'.$v['o_id'].'">
                            <td>
                                <div class="ckbox ckbox-success">
                                    <input type="checkbox" name="member" value="'.$v['o_id'].'" id="'.($v['o_id']+1).'">
                                    <label for="'.($v['o_id']+1).'"></label>
                                </div>
                            </td>
                            <td>
                                '.$v['o_id'].'
                            </td>
                            <td>
                                '.$v['o_name'].'
                            </td>
                            <td align="right">
                                <div onclick="exchange(this)" id="'.$v['o_name'].':'.$v['o_id'].'" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm" style="height: 30px;">修改密码</div>
                            </td>
                        </tr>';
            }
        }

        return $data .' <tr>
                    <td colspan="4" align="center">
                        <input style="width: 100px" class="btn btn-primary" onclick="delete_member()" type="button" value="删除">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            添加账户
                        </div>
                    </td>
                </tr>';
    }
    function show(){
        echo "holle";
    }
    function ruturn_wainning($warnning){
        $data['status'] = 0;
        if ($warnning) {
            $data['warn'] = $warnning;
        }
        echo(json_encode(data));
    }
}
?>