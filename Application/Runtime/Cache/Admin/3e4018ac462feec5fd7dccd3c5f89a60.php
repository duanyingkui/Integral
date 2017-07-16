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
                <li id="tables"><a href="/Integral/index.php/Tables/tables"><i class="fa fa-home"></i> <span>查看积分信息</span></a></li>
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
            
    <p>成员信息</p>

    <table class="table table-dark md30" id="member_table">
        <tbody>

            <!--<form action="delete" method="post">-->
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr id="<?php echo ($v["o_id"]); ?>">
                            <td>
                                <div class="ckbox ckbox-success">
                                    <input type="checkbox" name="member" value="<?php echo ($v["o_id"]); ?>" id="<?php echo ($v["o_id"]); ?>+1">
                                    <label for="<?php echo ($v["o_id"]); ?>+1"></label>
                                </div>
                            </td>
                            <td>
                                <?php echo ($v["o_id"]); ?>
                            </td>
                            <td>
                                <?php echo ($v["o_name"]); ?>
                            </td>
                            <td align="right">
                                <div onclick="exchange(this)" id="<?php echo ($v["o_name"]); ?>:<?php echo ($v["o_id"]); ?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm" style="height: 30px;">修改密码</div>
                            </td>
                        </tr><?php endforeach; endif; ?>
                <tr>
                    <td colspan="4" align="center">
                        <input style="width: 100px" class="btn btn-primary" onclick="delete_member()" type="button" value="删除">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            添加账户
                        </div>
                    </td>
                </tr>
            <!--</form>-->
        </tbody>
    </table>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加账户</h4>
                </div>
                <form action="add" method="post">
                    <div class="modal-body">
                            <input type="text" id="o_id" onkeyup="get_info_by_studentID(this)" placeholder="学号" class="form-control mb15" name="s_id">
                            <input type="text" id="o_name" placeholder="姓名" class="form-control mb15" name="s_name">
                        <p id="add_warning" style="color: red;margin-top: 0px;display: none;"></p><br/>
                    </div>

                    <div class="modal-footer">
                        <div type="button" id="Enter" class="btn btn-default" data-dismiss="modal">关闭</div>
                        <input  type="button" onclick="add_member()" class="btn btn-primary" value="提交">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h5 align="center" id="h5_name" class="modal-title">修改密码</h5>
                </div>
                <div class="modal-body" align="center">
                    <form action="">
                        <input type="hidden" id="h_id">
                        <input type="password" id="new_psd"  placeholder="新密码" class="form-control mb15" name="new_psd">
                        <input type="password" id="psd_again"  placeholder="验证新密码" class="form-control mb15" name="psd_again">
                        <p id="warning" style="color: red;display: none;"></p><br/>
                        <div type="button" id="dismiss_modal" class="btn btn-default" data-dismiss="modal">关闭</div>
                        <input  type="button"  onclick="modify()" class="btn btn-primary" value="提交">
                    </form>
                </div>
            </div>
        </div>
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

    <script type="text/javascript">
        const MODIFY_PASSWORD_FAILED      = "修改密码失败!";
        /*
         * 添加成员
         * */
        function add_member(){
            var id = document.getElementById('o_id').value;
            var name = document.getElementById('o_name').value;
            var hxr = new XMLHttpRequest();

            hxr.onreadystatechange = function (){
                if(hxr.readyState == 4){
                    var table = document.getElementById("member_table");
                    var rlst  = hxr.responseText;
                    var  rlt  = JSON.parse(rlst);

                    if(rlt.status == 1 ){
                        table.innerHTML = rlt.data;
                        set_input_null();
                        dismiss_fade_modal();
                    }else{
                        console.log(rlt);
                        show_add_Warning(rlt.warn);
                    }

                }
            };

            var pram = 's_id='+id+'&s_name='+name;
            hxr.open('post','add');
            hxr.setRequestHeader('content-type','application/x-www-form-urlencoded');
            hxr.send(pram);
        }
        /*
         * 删除成员
         */
        function delete_member() {
            var objs = document.getElementsByName("member");
            var prams   = "";
            for (var i = 0; i < objs.length; i++) {
                if (objs[i].checked) {
                    prams = prams+ "&"+objs[i].value+"="+objs[i].value;
                }
            }

            var hxr = new XMLHttpRequest();
            hxr.onreadystatechange= function (){
                if(hxr.readyState == 4){
                    var table = document.getElementById("member_table");
                    var rlst = hxr.responseText;
                    table.innerHTML = rlst;

                }
            };
            hxr.open('post','delete');
            hxr.setRequestHeader('content-type','application/x-www-form-urlencoded');
            hxr.send(prams);
        }
        function exchange(ele){
            var info         = ele.getAttribute('id');
            var doc          = document.getElementById('h_id');
            var title        = document.getElementById('h5_name');
            var infos        = info.split(":");
            doc.value        = infos[1];
            title.innerHTML  = "修改"+infos[0]+"的密码";
        }
        /*
         * 修改密码
         * */
        function modify(){

            var o_id = document.getElementById('h_id').value;
            var psd  = document.getElementById('new_psd').value;
            var psd_again = document.getElementById('psd_again').value;

            psd = psd.trim();
            psd_again.trim();

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function (){
                if(ajax.readyState == 4){
                    var  rlt = ajax.responseText;

                    if(rlt == "success"){
                        set_input_null();
                        dismiss_fade_modal();
                    }else if(rlt == "fail"){
                        showWarning(MODIFY_PASSWORD_FAILED);
                    }else{
                        showWarning(rlt);
                    }
                }
            };

            var info_str = "id=" + o_id + "&psd=" + psd +"&psd_again=" + psd_again;

            ajax.open('post','modify_psd');
            ajax.setRequestHeader('content-type','application/x-www-form-urlencoded');
            ajax.send(info_str);
        }
        /*
         *显示警告
         * */
        function showWarning(warning){

            var doc = document.getElementById('warning');

            doc.innerHTML = warning;
            doc.style.display = "inline";

            var time = setTimeout(function (){
                doc.innerHTML = "";
                doc.style.display = "none";
                clearTimeout(time);
                return;
            },5000);
        }
        function show_add_Warning(warning){

            var doc           = document.getElementById('add_warning');

            doc.innerHTML     = warning;
            doc.style.display = "inline";

            var time = setTimeout(function (){
                doc.innerHTML     = "";
                doc.style.display = "none";
                clearTimeout(time);
                return 0;
            },5000);
        }
        /*
        
        */
        function get_info_by_studentID(ele){
            
            var id       = ele.getAttribute('id');
            var id_input = document.getElementById(id).value;
            var ajax     = new XMLHttpRequest();
            ajax.onreadystatechange = function(){
                if (ajax.readyState == 4) {
                    var rps = ajax.responseText
                    var name_input = document.getElementById('o_name');
                    if (rps != '') {
                        name_input.value = rps;
                    };
                };
            }
            var pram = "s_id=" + id_input;
            ajax.open('post','get_studentinfo_by_id');
            ajax.setRequestHeader('content-type','application/x-www-form-urlencoded');
            ajax.send(pram);
        }
        /*
         *消失fade
         * */
        function dismiss_fade_modal(){
            var fade = document.getElementById('dismiss_modal');
            var fade1 = document.getElementById('Enter');
            fade.click();
            fade1.click();
        }
        function set_input_null(){
            document.getElementById('new_psd').value = "";
            document.getElementById('psd_again').value = "";
        }
    </script>

</body>
</html>