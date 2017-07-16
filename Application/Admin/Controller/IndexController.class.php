<?php
namespace Admin\Controller;
class IndexController extends BaseController {
    public function index(){
        $this->display('Index/index');
    }
    // 修改密码
    public function changeInfo(){
    	$this->display();
    }
    // 修改
    public function changePass(){
    	$office = M("office");
    	$map['o_id'] = $_SESSION['o_id'];	//获取当前用户的id
    	$old = $office->where($map)->field('o_psd')->find();	//找到当前用户的密码
    	if ($old) {
	    	$change_new = md5($_POST['c_NewPsd']);
	    	$change_newAgain = md5($_POST['c_NewPsdAgain']);
	    	if ($change_new == $change_newAgain) {	//重复输入密码一致
    			$change_old = md5($_POST['c_Psd']);	//获取数据库中的密码
	    		if ($change_old == $old['o_psd']) {	//原密码正确
					$data['o_psd'] = md5($_POST['c_NewPsd']);
					$re = $office->where($map)->save($data);	// 修改密码
					if ($re) {
						$this->ajaxReturn(5); // 修改成功
					}else{
						$this->ajaxReturn(6);	// 修改失败
					}
				}else{
					$this->ajaxReturn(7);	// 原密码输入有误
				}
	    	}else{
	    		$this->ajaxReturn(8);	// 两次密码不一致
	    	}
    	}else{
    		$this->ajaxReturn(9);	// 数据错误
    	}

    }
}