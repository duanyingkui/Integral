<?php
use Think\Controller;
define('ONE_CONTENT_NULL_WARNING',   '输入框不能有空!');
define('DOUBLE_CONTENT_NULL_WARNING','两个输入框不能为空!');
define('TOW_CONTENT_UNEQUAL_WARNING','内容必须一致!');
define('STUDENT_NUM_EXISTED',        '学号已存在!');
define('STUDENT_UNEXIST',            '这个学生不存在!');
define('FAIL',                       'fail');
define('SUCCESS',                    'success');
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/10/1
 * Time: 16:34
 */
//define("DEFAULT_PSD" ,"123456");
function student_is_exist($student_id){

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
//判断是否登陆
function is_login(){
    //判断是否登陆代码
    if (isset($_SESSION['o_id'])) {
    	return true;
    }else {
    	return false;
    }
}
function is_power()
{
    if (1 == $_SESSION["is_power"])
        return true;
    return false;
}


