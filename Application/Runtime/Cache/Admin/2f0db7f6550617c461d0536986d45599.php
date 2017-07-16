<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="/Public/Admin/bracket/css/style.default.css" rel="stylesheet">-->
    <link rel="stylesheet" href="/Public/Admin/bracket/css/dropzone.css" />
    <script src="/Public/Admin/bracket/js/jquery-1.11.1.min.js"></script>
    <script src="/Public/Admin/bracket/js/dropzone.min.js"></script>
    <script src="/Public/Admin/bracket/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/Public/Admin/bracket/js/jquery-ui-1.10.3.min.js"></script>
    <script src="/Public/Admin/bracket/js/bootstrap.min.js"></script>
    <script src="/Public/Admin/bracket/js/modernizr.min.js"></script>
    <script src="/Public/Admin/bracket/js/jquery.sparkline.min.js"></script>
    <script src="/Public/Admin/bracket/js/toggles.min.js"></script>
    <script src="/Public/Admin/bracket/js/retina.min.js"></script>
    <script src="/Public/Admin/bracket/js/jquery.cookies.js"></script>

    <script src="/Public/Admin/bracket/js/morris.min.js"></script>
    <script src="/Public/Admin/bracket/js/raphael-2.1.0.min.js"></script>

    <script src="/Public/Admin/bracket/js/custom.js"></script>
    <script src="/Public/static/layer/layer.js"></script>

    <script src="/Public/Admin/bracket/js/html5shiv.js"></script>
    <script src="/Public/Admin/bracket/js/respond.min.js"></script>
    <title>积分查询</title>
    
    <style>
        body{
            background-image: url("/Public/Admin/bracket/images/img/bgimg3.jpg");
        }
        .search_div{
            border: 1px white solid;
            border-radius: 50px;
            margin-top: 40px;
            height: 40px;
            background-color: transparent;
            vertical-align: middle;
            font-size: 10px;
            min-width: 260px;
            width: 90%;
        }
        .select-search{

            font-size: 18px;
            width: auto;
            margin-top: 10px;
            border: none;
            background-color: transparent;
            color: black;
            /*background-color:transparent;*/
            /*color:#fff;*/
            FILTER: alpha(opacity=0); /*androd*/

            appearance:none;
            -moz-appearance:none;
            -webkit-appearance:none;
        }
        h3{
            /*display: inline-block;*/
            color: #2e3032;
            font-family: "Helvetica Neue", "Hiragino Sans GB", "Microsoft YaHei", "\9ED1\4F53", Arial, sans-serif;
            font-weight: 400;
        }
        .header-title {
            height: 100px;
            width: auto;
            margin-top: 50px;
            vertical-align: middle;
        }
        /*.title{*/
            /*position: relative;*/
        /*}*/
        .xglogo{
            margin-top: 10px;
            height: 80px;
            width: 80px;
        }
        .select_class{

        }
        .search_btn{
            background-color: #0b919b;
            border: none;
            border-radius: 50px;
            height: 40px;
            font-size: 18px;
            width: 90%;
            /* word-spacing: 8px; */
            letter-spacing: 30px;
            text-decoration: initial;
            text-indent: 30px;
            margin-top: 40px;
        }
        /*.search_btn:hover{*/
            /*background-color: green;*/
        /*}*/
        /*.search_btn:focus{*/
            /*background-color: green;*/
        /*}*/
        .ipt-class{
            background-color: transparent;
            color: black;
            border: 1px white solid;
            height: 40px;
            border-radius: 50px;
            left: 10px;
            min-width: 260px;
            font-size: 18px;
            width: 90%;
            text-align: center;
            margin-top: 50px;
        }
        #place{
            margin-top: 50px;
            font-size: 18px;
            display: block;
            position: absolute;
            z-index: -1;
            color: #403939;
            left: 0;
            top: 7px;
            width: 100%;
            height: 50px;
            align-content:center;
        }
        .admin{
            margin-top: 20px;
            font-size: 15px;
            float: right;
            color: red;
            margin-left: -5px;
            margin-right: 29px;
        }
        .term-iron{
            height: 25px;
            width: 31px;
            margin-top: -11px;
        }
        .title{
            margin-bottom: 20px;
        }
    </style>

    <style>
        .contentDiv{
            top: 0px;
            bottom: 0px;
            /*left: 10px;*/
            /*right: 10px;*/
            width: auto;
            /*height: auto;*/
            height: 550px;

        }
        .footDiv{
            /*position: fixed;*/
            /*bottom: 0px;*/
            color: black;
            width: 100%;
        }
        .admin-footer{
            font-size: 10px;
            color: black;

        }
        .contentD{
            height: 550px;
            /*background-color: red;*/
        }
        #adn{
            display: inline-block;
        }
        #adnf{
            font-size: 15px;
            display: inline-block;
        }
    </style>
</head>
<body class="body-class">
<div class="contentDiv" align="center">
    <div class="contentD">
        
    <div class="header-title">
        <div class="title">
            <img class="xglogo" src="/Public/Admin/bracket/images/img/xglogo_latest.png">
            <h3><b>学生综合素质积分查询</b></h3>
        </div>
    </div>
    <div class="col-md-6" style="width: 100%;min-width: 260px;margin-top: 50px;left: 0px; border: none;">
        <form id="form1" action="search" method="post" class="form-horizontal" style="min-width:260px;width: auto;border: none;">
                <p id="place">请输入学号</p>
                <input type="tel" id="ipt" onfocus="getFcs();" onblur="missFcs();" placeholder=""  name="s_id" class="ipt-class">
                <div class="search_div">
                    <select class="select-search" name="term" id="slct_term">
                    </select>
                    <img  class="term-iron" src="/Public/Admin/bracket/images/img/term-iron.png">
                </div>
                <!--<div class="panel-footer" style="border: none;margin-top: 20px;background-color: transparent;">-->
                    <input class="btn btn-primary search_btn" type="submit" value="查询">
                    <a id="adn" class="admin" href="/index.php/Admin/login">管理员登陆</a>
                <!--</div>&lt;!&ndash; panel-footer &ndash;&gt;-->
        </form>
    </div>


    </div>
    
    <div class="footDiv" align="center">
        <a id="adnf" class="admin-footer" href="http://www.marchsoft.cn" target="_self">
            <p>&copy;三月软件提供技术支持</p>
        </a>
    </div>
    
</div>


    <script>

        var select = document.getElementById('slct_term');
        var dat = new Date();
        var cur_month = dat.getMonth() + 1;
        var cur_year  = dat.getFullYear();
        var ele = "";
        var de_t = cur_year - 2014;
        var term_num = 2*de_t;
        if(cur_month >= 9){
            de_t += 1;
        }
        var ajax = new  XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4){
                var rsp = JSON.parse(ajax.responseText);
                rsp.reverse();
                for(var i = 0;i < rsp.length;i++){
                    ele += "<option value=\""+rsp[i].sc_term+"\" style=\"background-color:transparent;\">"+rsp[i].sc_term+"</option>";
                }
                console.log(ele);
                select.innerHTML = ele;
            }
        };
        var pram = "term=term";
        ajax.open('post','getTerm');
        ajax.setRequestHeader('content-type','application/x-www-form-urlencoded');
        ajax.send(pram);

//        var from = 2014;
//        var to   = 2015;
//
//        console.log(cur_month);
//        console.log(de_t);

    </script>
    <script>
        var ipt = document.getElementById('ipt');
        if(ipt.value != ""){
            getFcs();
        }
        function getFcs(){

            var ele = document.getElementById('place');
            ele.innerHTML = "";
        }
        function missFcs(){
            var ipt = document.getElementById('ipt');
            if(ipt.value != ""){
                return;
            }
            var ele = document.getElementById('place');
            ele.innerHTML = "请输入个人学号";
        }
    </script>

</body>
</html>