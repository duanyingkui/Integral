<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=0.85, maximum-scale=1.0, user-scalable=0" name="viewport">     
<!-- <meta content="yes" name="apple-mobile-web-app-capable">     
<meta content="black" name="apple-mobile-web-app-status-bar-style">     
<meta content="telephone=no" name="format-detection"> -->
<title>信工学院积分管理系统</title>
<link rel="shortcut icon" href="/Integral/Public/Admin/bracket/images/logo.png" type="image/png">
<script src="/Integral/Public/Admin/bracket/js/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="/Integral/Public/Admin/bracket/css/newCss/login.css">
<meta name="GENERATOR" content="MSHTML 11.00.9600.17496">
<style type="text/css">
    
</style>
</head>
<body>
<div class="top_div" style="text-align: center;">
    <h1 style="font-family: '宋体';font-size: 3em;padding-top: 100px;color: white;">信工学院积分管理系统</h1>
</div>
<div style="background: rgb(255, 255, 255); 
            margin: -100px auto; 
            border: 1px solid rgb(231, 231, 231); 
            border-image: none; 
            width: 400px; 
            height: 200px; 
            text-align: center;">

    <div style="width: 165px; height: 96px; position: absolute;">
        <div class="tou"></div>
        <div class="initial_left_hand" id="left_hand"></div>
        <div class="initial_right_hand" id="right_hand"></div>
    </div>

    <form method="post">
        <P style="padding: 30px 0px 10px; position: relative;display: block;">
            <span  class="u_logo"></span>
            <input class="ipt" type="tel" id="uname" name="name" placeholder="请输入用户名" value=""> 
        </P>
        <P style="position: relative;"><span class="p_logo"></span>         
            <input  class="ipt" type="password" id="pword" name="psd" placeholder="请输入密码" value="">   
        </P>

        <p id="loginMsg" style="height: 23px;color: red;padding-top: 11px;">  </p>

        <div style="height: 50px; border-top-color: rgb(231, 231, 231); border-top-width: 1px; border-top-style: solid;">
            <P style="margin: 0px 35px 20px 35px;padding-top: 10px;">
                <input type="button" value="Sign In" style="width: 330px;background: rgb(0, 142, 173); padding: 7px 0; border-radius: 4px; border: 1px solid rgb(26, 117, 152); border-image: none; color: rgb(255, 255, 255); font-weight: bold;"  onclick="loginBtn()" />
            </P>
        </div>
    </form>
</div>
<div style="text-align:center;"></div>
<script  type="text/javascript">
$(function(){
    //得到焦点
    $("#pword").focus(function(){
        $("#left_hand").animate({
            left: "150",
            top: " -38"
        },{step: function(){
            if(parseInt($("#left_hand").css("left"))>140){
                $("#left_hand").attr("class","left_hand");
            }
        }}, 2000);
        $("#right_hand").animate({
            right: "-64",
            top: "-38px"
        },{step: function(){
            if(parseInt($("#right_hand").css("right"))> -70){
                $("#right_hand").attr("class","right_hand");
            }
        }}, 2000);
    });
    //失去焦点
    $("#pword").blur(function(){
        $("#left_hand").attr("class","initial_left_hand");
        $("#left_hand").attr("style","left:100px;top:-12px;");
        $("#right_hand").attr("class","initial_right_hand");
        $("#right_hand").attr("style","right:-112px;top:-12px");
    });
});
</script>
<script>
    document.onkeydown=function(event){
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if(e && e.keyCode==13){
          loginBtn();
        }
    }; 
    function loginBtn(){
        var oid = $.trim($("#uname").val());
        var opsd = $("#pword").val();
        if ($.trim(oid) == '') {
            clearPrompt("#loginMsg","#uname",1);
        }else if(isNaN($.trim(oid))){
            clearPrompt("#loginMsg","#uname",2);
        }else{ 
            if ($.trim(opsd) == '') {
                clearPrompt("#loginMsg","#pword",3);
            }else{
                $.post(
                    "/Integral/index.php/Admin/login/login",
                    {
                        o_id:oid,
                        o_psd:opsd
                    },function(data){
                        var retn_msg = eval(data);
                        console.log(retn_msg.wrong);
                        if (retn_msg.wrong == 1) {
                            window.location.href="/Integral/index.php/Admin/Index/index";
                        }else if(retn_msg.wrong == 2){
                            showMsg(retn_msg.data);
                        }else{
                            wrongPromt("#loginMsg");
                        }
                    }
   
                );
            }
        }
    }

    // 清除提示信息
    function clearPrompt($msg,$p,$k){

        var msg = $($msg);
        var p = $($p);
       if ($k==1) {
            $(msg).html("账号不能为空  ^_^");
        }else if($k==2){
            $(msg).html("账号必须为数字 ^_^");
        }else if($k==3){
            $(msg).html("密码不能为空 ^_^");
        }else{
            $(msg).html("密码或密码有误 ^_^");
        }
        $(p).css("border","1px solid red");
        setTimeout(function(){
            $(msg).html(" ");
        },3000);
    }

    function showMsg(msg){
        $("#loginMsg").html(msg);

        setTimeout(function(){
            $("#loginMsg").html(" ");
        },1500);
    }
    function wrongPromt(id){
        var id = id;
        $(id).html("账号或密码有误 ^_^");
        setTimeout(function(){
            $(id).html(" ");
        },3000);
    }
</script>
</body>
</html>