<?php 
namespace Admin\Model;
use Think\Model;
class ScoredetailModel  extends Model{
	protected $_validate =array(
		array('s_id','require','学号不能为空'),
		array('s_name','require','姓名不能为空！'), 
		array('c_name','require','班级不能为空！'), 
		array('sc_number','require','积分不能为空！'),
		array('sc_reason','require','原因不能为空！'), 
		array('sc_time','require','时间不能为空！'),
		array('sc_who','require','录入者不能为空！'), 
		array('sc_union','require','部室不能为空！'),
	);	

	public function find(){
		$id = $this->s_id;
		$name = $this->s_name; 
		  
		// 先查询这个用户名是否存在
		$user = M('student')->where(array('s_id' => array('eq', $id),))->find();
		    if($user){
				if($user['s_name'] == $name){		 
		              return true;
				}else{
		               $this->error = '学号姓名不匹配！';
		              return false;
				}
		    }else {
				$this->error = '学号不存在！';
				return false;
		    }
		}

}