<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/Integral/Public/Admin/bracket/images/logo.png" type="image/png">
    <title>信息工程学院积分管理系统</title>
    <link href="/Integral/Public/Admin/bracket/css/style.default.css" rel="stylesheet">
    <link rel="stylesheet" href="/Integral/Public/Admin/bracket/css/dropzone.css" />
    <script src="/Integral/Public/Admin/bracket/js/dropzone.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/jquery-1.11.1.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/jquery-ui-1.10.3.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/bootstrap.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/modernizr.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/jquery.sparkline.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/toggles.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/retina.min.js"></script>
    <!-- <script src="/Integral/Public/Admin/bracket/js/jquery.cookies.js"></script> -->

    <script src="/Integral/Public/Admin/bracket/js/morris.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/raphael-2.1.0.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/jquery.datatables.min.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/custom.js"></script>
    <script src="/Integral/Public/Admin/bracket/js/select2.min.js"></script>
    <script src="/Integral/Public/static/layer/layer.js"></script>
    

    

</head>
<body>
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="leftpanel">
        <div class="logopanel" align="center">
            <h1>
                <span>积分管理系统</span>
            </h1>
        </div>

        <div class="leftpanelinner">
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media userlogged">
                    <img alt="" src="/Integral/Public/Admin/bracket/images/photos/loggeduser.png" class="media-object">
                    <div class="media-body">
                        <h4> <?php echo ($_SESSION['o_name']); ?></h4>
                    </div>
                </div>

                <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                    <li><a href='#'  data-toggle="modal" data-target="#mymodal-data"><i class="glyphicon glyphicon-user"></i>修改密码</a></li>
                    <li><a href="#" id="logout_a" onclick="logOut()"><i class="glyphicon glyphicon-log-out"></i>退出</a></li>
                </ul>
            </div>

            <h5 class="sidebartitle">信息工程学院</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket">
                <li id="tables"><a href="/Integral/index.php/Admin/Tables/tables"><i class="fa fa-home"></i> <span>查看积分信息</span></a></li>
                <li id="input"><a href="/Integral/index.php/Admin/input"><i class="fa fa-th-list"></i> <span>积分信息录入</span></a></li>
                <li id="class"><a href="/Integral/index.php/Admin/class"><i class="fa fa-th-list"></i> <span>学生信息录入</span></a></li>               
                
                    <?php if($_SESSION['is_power'] == 1): ?><li id="member"><a href="/Integral/index.php/Admin/Manage/member"><i class="fa fa-th-list"></i> <span>成员管理</span></a></li>
                        <li id="Term"><a href="/Integral/index.php/Admin/Term"><i class="fa fa-th-list"></i> <span>学期管理</span></a></li><?php endif; ?>
                
                <li id="index"><a href="/Integral/index.php/Admin/index"><i class="fa fa-th-list"></i> <span>友情提示</span></a></li>
            </ul>
        </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->

    <div class="mainpanel">
        <div class="headerbar">
            <a class="menutoggle"><i class="fa fa-bars">
            </i></a>
            <div class="header-right">
                <ul class="headermenu">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="/Integral/Public/Admin/bracket/images/photos/loggeduser.png" alt="" />
                                <?php echo ($_SESSION['o_name']); ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href='#'  data-toggle="modal" data-target="#mymodal-data"><i class="glyphicon glyphicon-user"></i>修改密码</a></li>
                                <li><a href="#" id="logout_a" onclick="logOut()"><i class="glyphicon glyphicon-log-out"></i>退出</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- header-right -->
        </div><!-- headerbar -->
        <div class="contentpanel">
            
	<div id="c-top"></div>
	<link rel="stylesheet" href="/Integral/Public/Admin/bracket/css/overBar/overhang.min.css">
	<script src="/Integral/Public/Admin/bracket/js/overBar/jquery-ui.min.js"></script>
	<script src="/Integral/Public/Admin/bracket/js/overBar/overhang.min.js"></script>
<script>
//用window的onload事件，窗体加载完毕的时候
window.onload=function(){
	setTimeout(function(){
		$('#c-top').overhang({},"欢迎使用 积分管理系统 ^_^");
	},1000);
}
/*setTimeout(function(){
	window.location.href="http://localhost/Integral/index.php/Admin/input";	
},7000);*/
</script>
<div id="center0" style="padding:5% 17%;;height: 500px;margin:0 auto;word-wrap: break-word;">
	<h2>友情提示：</h2><br>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如您在使用过程中出现问题，无法导入EXCEL文件，请先检查EXCEL表格格式是否有误,或者换个浏览器试试。如有技术问题，请联系我们。</p> <br>
	<p>责任人：王飞&nbsp;&nbsp;李云&nbsp;&nbsp;宋鸿浩&nbsp;&nbsp;段莹奎</p>
	<p>联系QQ：1368510132</p>
	<p>技术支持：三月软件工作室</p>
	<p>工作室地址：信息工程学院主楼 0#906</p>
</div>

        </div>
    </div><!-- mainpanel -->

</section>
<!-- 模态弹出窗内容 -->
<div class="modal fade" id="mymodal-data" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">用户 <?php echo ($_SESSION['o_name']); ?> 修改密码</h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-md-5" >
                        <form method="post">
                            <br>
                            <p class="form-control changeUName" style="cursor: not-allowed;"><?php echo ($_SESSION['o_id']); ?></p>
                            <br>
                            <input type="password" class="form-control " id="oldPsd" placeholder="请输入原密码" /><br>
                            <input type="password" class="form-control " id="changeNewPsd" placeholder="请输入要修改的密码" /><br>
                            <input type="password" class="form-control " id="changeNewPsdAgain" placeholder="请再次输入要修改的密码" /><br>
                            <p id="showMsg" style="color:red;height: 21px;"> </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="checkBtn()">保存</button>
            </div>
        </div>
    </div>
</div>
<script>
    function logOut(){
        layer.open({
            content: '您确定退出本系统吗?',
            btn: ['确认', '取消'],
            shadeClose: false,
            yes: function(){
                window.location.href = '/Integral/index.php/Admin/login/logout';
            }, no: function(){

            }
        });
    }
    document.onkeydown=function(event){
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if(e && e.keyCode==13){
            checkBtn();
        }
    };
    function checkBtn(){
        var oldPsd = $("#oldPsd").val();
        var changeNewPsd = $("#changeNewPsd").val();
        var changeNewPsdAgain = $("#changeNewPsdAgain").val();

        if ($.trim(oldPsd) == '') {
            $("#showMsg").html(checkMsg(1));
            clearMsg();
        }else{
            if ($.trim(changeNewPsd) == '') {
                $("#showMsg").html(checkMsg(2));
                clearMsg();
            }else if ($.trim(changeNewPsdAgain) == '') {
                $("#showMsg").html(checkMsg(3));
                clearMsg();
            }else if($.trim(oldPsd)==$.trim(changeNewPsdAgain)){
                $("#showMsg").html(checkMsg(4));
                clearMsg();
            }else {
                $.post(
                        "/Integral/index.php/Admin/index/changePass",
                        {
                            c_Psd:oldPsd,
                            c_NewPsd:changeNewPsd,
                            c_NewPsdAgain:changeNewPsdAgain
                        },function(data){
                            if(data==5) {
                                alert("密码修改成功");
                                window.location.href="";
                            }else if(data==6) {
                                $("#showMsg").html(checkMsg(6));
                                clearMsg();
                            }else if(data==7) {
                                $("#showMsg").html(checkMsg(7));
                                clearMsg();
                            }else if(data==8){
                                $("#showMsg").html(checkMsg(8));
                                clearMsg();
                            }else if(data==9){
                                $("#showMsg").html(checkMsg(9));
                                clearMsg();
                            }
                        }
                );
            }
        }
    }
    function checkMsg($msg){
        if ($msg == 1) {
            return "原始密码不能为空";
        }else if($msg==2){
            return "修改的密码不能为空";
        }else if($msg==3){
            return "再次输入修改的密码不能为空";
        }else if($msg==4){
            return "不能和原始的密码相同";
        }else if($msg==6){
            return "密码修改失败";
        }else if($msg==7){
            return "原密码输入有误";
        }else if($msg==8){
            return "两次密码不一致";
        }else if($msg==9){
            return "数据错误";
        }
    }
    function clearMsg(){
        setTimeout(function(){
            $("#showMsg").html(" ");
        },3000);
    }
</script>

<script type="text/javascript">
    var strUrl=window.location.href;
    var arrUrl=strUrl.split("/");
    var strPage=arrUrl[arrUrl.length-1];
    var nm = strPage.split('.');
    var ele = document.getElementById(nm[0] + "");
//    alert(ele);
    ele.className = 'active';


</script>


</body>
</html>