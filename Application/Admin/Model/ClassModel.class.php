<?php 
namespace Admin\Model;
use Think\Model;
class ClassModel  extends Model{
	protected $_validate =array(
		array('c_name','require','班级名称不能为空！'), 
		array('c_name','/^[a-z0-9\x{4e00}-\x{9fa5}]{2,20}$/u','班级名称格式错误！',1,'regex'),
	);	
}