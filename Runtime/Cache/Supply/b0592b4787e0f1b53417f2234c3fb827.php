<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>后台管理</title>
        <meta name="keywords" content="请填写项目关键字" />
        <meta name="description" content="请填写项目介绍" />
        <meta name="copyright" content="Commerz" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/style.css" />
        <script language="javascript" type="text/javascript" src="__PUBLIC__/Js/jquery.core.js"></script>
    </head>
    <body class="login">
        <div class="loginbg">
            <form action="__APP__/Login-login" method="post" name="form" id="form">
                <div class="login_name"><input type="text" name="name" value="" class="login_input"/><div class="name_tip">用户名：</div></div>
                <div class="login_pwd"><input type="password" name="password" value="" class="login_input"/><div class="pwd_tip">密码：</div></div>
                <div class="login_btn"><input type="submit" name="submit" value=" " class="login_sub"/></div>
            </form>
        </div>
    </body>
</html>
<script language="javascript" charset="utf-8">
    $(function(){
        // 文档就绪
        $("input[name='name']").focus(function(){
            $('.name_tip').hide();
        });
        $("input[name='pwd']").focus(function(){
            $('.pwd_tip').hide();
        });
        $('.name_tip').click(function(){
           $("input[name='name']").focus();
           $('.name_tip').hide(); 
        });
        $('.pwd_tip').click(function(){
           $("input[name='pwd']").focus();
           $('.pwd_tip').hide(); 
        });
        $("input[name='name']").blur(function(){
           if($("input[name='name']").val()===''){
               $('.name_tip').show();
           }
        });
        $("input[name='pwd']").blur(function(){
           if($("input[name='pwd']").val()===''){
               $('.pwd_tip').show();
           }
        });
    });
</script>