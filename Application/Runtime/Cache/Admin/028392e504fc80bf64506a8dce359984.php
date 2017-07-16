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
    
    <link href="/Integral/Public/Admin/bracket/css/jquery.datatables.css" rel="stylesheet">
    <link href="/Integral/Public/Admin/bracket/css/pagelist.css" rel="stylesheet">
    <script src="/Integral/Public/Admin/bracket/js/showdate.js"></script>
    <style type="text/css">
      .put {
        float:left;
        margin-left:20px;
        margin-top: 10px;
      }
      .nav-bracket #tables a {
        background-color: #1caf9a;
        color: #fff;
      }      
      </style>


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
                   
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <!-- <a href="" class="minimize">&minus;</a> -->
          </div><!-- panel-btns -->
          <h3 class="panel-title">积分表</h3>
          <div class="panel-body" style="height: auto;">
              <form id="searchForm" name="searchform" class="well form-search" method="post"  onSubmit="check();" enctype="multipart/form-data" style="background-color:white;">
              <!-- 学号 -->
              <div class="put">
                <input placeholder="按学号检索" name="search[s_id]" value="<?php echo ($search['s_id']); ?>" list="id_name" class="form-control" autocomplete="off" width="130px">
                <datalist id="id_name">
                  <?php if(is_array($id_name)): foreach($id_name as $key=>$vo): ?><option value="<?php echo ($vo["s_id"]); ?>"></option><?php endforeach; endif; ?>
                </datalist>
              </div>
              <!-- 班级 -->
              <div class="put">
                <input placeholder="按班级检索" name="search[c_name]" value="<?php echo ($search['c_name']); ?>" list="name" class="form-control" autocomplete="off" width="130px">
                <datalist id="name">
                  <?php if(is_array($c_name)): foreach($c_name as $key=>$vo): ?><option value="<?php echo ($vo["c_name"]); ?>"></option><?php endforeach; endif; ?>
                </datalist>
              </div>
              <!-- 学期 -->
              <div class="put">
                <input placeholder="按学期检索" name="search[sc_term]" value="<?php echo ($search['sc_term']); ?>" list="term" class="form-control" autocomplete="off" width="130px">
                <datalist id="term">
                  <?php if(is_array($term)): foreach($term as $key=>$vo): ?><option value="<?php echo ($vo["sc_term"]); ?>"></option><?php endforeach; endif; ?>
                </datalist>
              </div>
              <!-- 部室 -->
              <div class="put">
                <input placeholder="按部室检索" name="search[sc_union]" value="<?php echo ($search['sc_union']); ?>" list="union" class="form-control" autocomplete="off" width="130px">
                <datalist id="union">
                  <?php if(is_array($union)): foreach($union as $key=>$vo): ?><option value="<?php echo ($vo["sc_union"]); ?>"></option><?php endforeach; endif; ?>
                </datalist>
              </div>
              <!-- 导入时间 -->
              <?php if($_SESSION['is_power'] == 1): ?><div class="put">
                  <input id="time1" placeholder="按导入时间检索" name="search[sc_uploadtime]" value="<?php echo ($search['sc_uploadtime']); ?>" class="form-control" autocomplete="off" onClick="return Calendar('time1');" width="130px"/>
                </div><?php endif; ?>
              
                <div style="float:right;margin-right: 40px;margin-top: 10px;">      
                  <input type="image" title="搜索" src="/Integral/Public/Admin/bracket/images/search2.png" style="width: 35px;height: 35px;" onclick="checkaction(1);"/>
                  <input type="image" title="导出" id="btn" src="/Integral/Public/Admin/bracket/images/cloud1.png" style="width: 35px;height: 35px;margin-left: 10px;" onclick="checkaction(0);"/>
                </div>     
              </form>
        </div>
        <br>
        <hr>
        <div class="panel-body" style="overflow: auto;padding: 3px">         
          <div class="table-responsive" id="list">         
          <form style="min-width:990px;">
          <a class="btn btn-xs btn-info pull-left mr-5" id="discard" href="javascript:void(0);">删除</a>
          <!-- <a class="btn btn-xs btn-info pull-left mr-5" style="margin-left: 20px;" id="clearAll" href="javascript:void(0);">一键删除</a>         -->
          <table class="table table-striped" id="table2" align="center">
              <thead>
                  <tr>
                    <th><input class="all" type="checkbox" class="" /></th>
                    <th width="50px">学号</th>
                    <th width="80px">姓名</th>
                    <th width="100px">班级</th>
                    <th>分数</th>
                    <th width="150px">原因</th>
                    <th width="120px">时间</th>                   
                    <th width="80px">部室</th>
                    <th>记录/修改者</th>
                    <th>修改时间</th>
                    <th>操作</th>
                  </tr>
              </thead>
              <tbody>
              <?php if($list): if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                      <td><input name="delete[]" type="checkbox" value="<?php echo ($vo["id"]); ?>"/></td>
                      <td><?php echo ($vo["s_id"]); ?></td>
                      <td><?php echo ($vo["s_name"]); ?></td>
                      <td><?php echo ($vo["c_name"]); ?></td>
                      <td><?php echo ($vo["sc_number"]); ?></td>
                      <td><?php echo ($vo["sc_reason"]); ?></td>
                      <td><?php echo ($vo["sc_time"]); ?></td>
                      <td><?php echo ($vo["sc_union"]); ?></td>                      
                      <td class="center"><?php echo ($vo["sc_who"]); ?></td>
                      <td class="center">
                        <?php if($vo["sc_modifytime"] != 0): echo (date('Y-m-d',$vo["sc_modifytime"])); endif; ?>
                      </td>
                      <td class="center">
                        <a class="btn btn-xs btn-info mr-5" href="javascript:void(0);" data-toggle="modal" data-target="#myModal" onclick="tables(this)" data-id="<?php echo ($vo["id"]); ?>">修改</a>
                      </td>
                  </tr><?php endforeach; endif; ?>
                <?php else: ?>
                  <tr><td></td><td width="120px">暂无相关信息</td></tr><?php endif; ?>            
              </tbody>
           </table>
          </form>
          </div><!-- table-responsive -->
          <div class="pagelist"><?php echo ($page); ?></div>
        </div><!-- panel-body -->
      </div><!-- panel -->        
    </div><!-- contentpanel -->
<!-- 修改 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">积分修改</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-bordered" method="post">
              <div class="form-group">
                <input type="hidden" name="id">
                <label class="col-sm-3 control-label" ></label>
                <div class="col-sm-6">
                   学号 <input type="text" disabled="" name="s_id" class="form-control" id="s_id" maxlength="11" />
                  <span class="Validform_checktip"></span> 
                  <br>
                   姓名 <input type="text" disabled="" name="s_name" class="form-control" id="s_name" maxlength="11"/>
                  <span class="Validform_checktip"></span>
                  <br>
                   班级 <input type="text" disabled="" name="c_name" class="form-control" id="c_name"/>
                  <span class="Validform_checktip"></span>
                  <br>
                   积分 <input type="text" name="sc_number" class="form-control" id="sc_number"  nullmsg="请填写积分！"/>
                  <span class="Validform_checktip"></span>
                  <br>
                   原因 <input type="text" name="sc_reason" class="form-control" id="sc_reason"/>
                  <span class="Validform_checktip"></span>
                  <br>
                   部室 <input type="text" disabled="" name="sc_union" class="form-control" id="sc_union"/>
                  <span class="Validform_checktip"></span>
                  <br>
                   时间 <input type="text" naem="sc_time" class="form-control" id="sc_time"/>
                  <span class="Validform_checktip"></span>
                  <br>
                  修改人<input type="text" name="sc_who" class="form-control" id="sc_who"/>
                  <span class="Validform_checktip"></span>
                  <input type="hidden" id="edit_id_update">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary" id="editform">保存</button>
          </div>
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
  
<script>
  $(function(){
    $(".pagelist a").live('click',function(){
      var pageObj = this;
      var url = pageObj.href;
      $.ajax({
        type:'get',
        url:url,
        success:function(res){
           $(".panel-body").html(res);
        }
      })
      return false;
    })
  })
</script>
<script type="text/javascript">
 $('.all').click(function() {
    if($(this).is(':checked')) {
      $(':checkbox').attr('checked', 'checked');
    } else {
      $(':checkbox').removeAttr('checked');
    }
  });
  // 删除操作
  $('#discard').click(function() {
    if($(':checked').size() > 0) {
      layer.confirm('确定要删除吗？', {
        btn: ['确定','取消'],
        shade: false 
      }, function(){
        $.post("<?php echo U('Tables/delete');?>", {data: $('form').serializeArray()}, function(res) {
          if(res.state == 1) {
            layer.msg(res.message, {icon: 2, time: 1000});
          } else {
            layer.msg(res.message, {icon: 1, time: 1000});
          }
          setTimeout(function() {
            location.reload();
          }, 1000);
        });
      }, function(){
        layer.msg('取消了删除操作！', {time: 1000});
        $(':checkbox').removeAttr('checked');
      });
    } else {
      layer.alert('没有选择！');
    }
  });
</script>

<!-- <script type="text/javascript">
  $('#btn').click(function(){
    if ($("#c_name").val() == "" && $("#s_id").val() == "" && $("#sc_union").val() == "") {
        layer.alert("搜索条件不能为空");
        return false;
      }
  });
</script> -->

<script type="text/javascript">
function checkaction(v){ 
  if(v==0){ 
  document.searchform.action="<?php echo U('Tables/export');?>";

  }else{ 
  document.searchform.action="<?php echo U('Tables/tables');?>"; 
  } 
  searchform.submit(); 
} 
</script>

<script type="text/javascript">
    function tables(ss){
      var edit_id = $(ss).data('id');
      var url = "<?php echo U('Tables/edit');?>";
      $.post(url,{
        'edit_id':edit_id
      },function(msg){
        $("#s_id").val(msg.s_id);
        $("#s_name").val(msg.s_name);
        $("#c_name").val(msg.c_name);
        $("#sc_number").val(msg.sc_number);
        $("#sc_reason").val(msg.sc_reason);
        $("#sc_time").val(msg.sc_time);
        $("#sc_union").val(msg.sc_union);
        $("#sc_who").val(msg.sc_who);
        $("#edit_id_update").val(msg.id);
      });
    };

    $("#editform").click(function(){
      var url = "<?php echo U('Tables/save');?>";
      if ($("#sc_number").val() == "") {
        layer.alert("积分不能为空");
        return false;
      }
      if ($("#sc_reason").val() == "") {
        layer.alert("积分原因不能为空");
        return false;
      }
      if ($("#sc_time").val() == "") {
        layer.alert("时间不能为空");
        return false;
      }
      if ($("#sc_who").val() == "") {
        layer.alert("修改人不能为空");
        return false;
      }
      $.post(url,{
        'id':$("#edit_id_update").val(),
        's_id':$("#s_id").val(),
        's_name':$("#s_name").val(),
        'c_name':$("#c_name").val(),
        'sc_number':$("#sc_number").val(),
        'sc_reason':$("#sc_reason").val(),
        'sc_time':$("#sc_time").val(),
        'sc_union':$("#sc_union").val(),
        'sc_who':$("#sc_who").val()
      },function(msg){
        layer.msg("修改成功！");
        setTimeout(function(){
            location.reload();
        },1000);          
      });                                                       
    });
</script>


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