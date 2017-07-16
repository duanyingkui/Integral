<?php 
namespace Admin\Model;
use Think\Model;
class TermModel extends Model{
	protected $_validate =array(
		array('sc_term','require','学期不能为空'),
		array('sc_term','','该学期已经存在！',0,'unique',1),
	);
}