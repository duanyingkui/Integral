<?php 
namespace Admin\Model;
use Think\Model;
class MarchModel  extends Model{
	protected $_validate =array(
		array('m_id','require','学号不能为空'),
		// array('m_id','','该学号已经存在！',0,'unique',1),
		array('m_name','require','姓名不能为空！'), 
		array('m_class','require','班级不能为空！'), 
		array('m_sex','require','性别不能为空！'),
		array('m_born','require','生日不能为空！'), 
		array('m_place','require','籍贯不能为空！'),
		array('m_address','require','现居地不能为空！'), 
		array('m_hobby','require','爱好不能为空！'),
		array('m_domanial','require','所关注技术领域不能为空！'),
		array('m_qq','require','QQ不能为空！'),
		array('m_phone','require','手机号不能为空！'),
		array('m_email','require','邮箱不能为空！'),
		array('m_explain','require','个人说明不能为空！'),
		array('m_date','require','入小组时间不能为空！'),

	);


}