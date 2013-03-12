<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>后台管理</title>
        <meta name="keywords" content="请填写项目关键字" />
        <meta name="description" content="请填写项目介绍" />
        <meta name="copyright" content="Commerz" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/style.css" />
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/system.css" />
        <script language="javascript" type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script>
    </head>
    <body>
        <!-- Top Start { -->
        <div class="head">
            <div class="logo"><a href="__APP__/Index-index" class="txt_fff">婴格经贸有限公司管理系统</a></div>
            <div class="system">
                <ul>
                    <li><a href="__APP__/Goods-orderList">商品智能补货系统</a></li>
                    <li><a href="#">订单登记管理系统</a></li>
                </ul>
            </div>
        </div>
        <!-- } Top End -->
        <!-- Body Start { -->
        <div class="body">
            <!-- Left Start { -->
            <div class="main_left">
                <div class="admininfo">
                    <p>欢迎您：<?php echo ($_SESSION['loginUserName']); ?></p>
                    <p>隶属部门：<?php echo ($_SESSION['department']); ?></p>
                    <p><a href="__APP__/Index-changePwd">修改密码</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Login-unlogin">退出系统</a></p>
                </div>
                <div class="system_menu">
                    <h2>系统全局管理</h2>
                    <ul>
                        <li><a href="">系统首页</a></li>
                        <li><a href="">管理团队设置</a></li>
                        <li><a href="">数据库管理</a></li>
                    </ul>
                </div>
                <div class="system_info">
                    <h2>服务器信息</h2>
                    <ul>
                        <li>服务器系统：<br /><span><?php echo ($info['操作系统']); ?></span></li>
                        <li>服务器环境：<br /><span><?php echo ($info['运行环境']); ?></span></li>
                        <li>ThinkPHP版本：<br /><span><?php echo ($info['ThinkPHP版本']); ?></span></li>
                        <li>服务器时间：<br /><span><?php echo ($info['服务器时间']); ?></span></li>
                        <li>剩余空间：<br /><span><?php echo ($info['剩余空间']); ?></span></li>
                    </ul>
                </div>
            </div>
            <!-- } Left End -->
            <!-- Main Start { -->
            <div class="main">
                <!-- Content Start { -->
                <div class="content">
                    <!-- 路径导航 Start ｛ -->
                    <div class="blkBreadcrumbNav txt_636363"><span class="blkBreadcrumbNav_ico"></span><a href="__APP__">管理中心</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="__APP__">系统首页</a></div>
                    <!-- } 路径导航 End -->
                    <div class="system_note f14">婴格经贸有限公司管理系统保护多个内部系统，仅供内部使用，所需权限请到电子商务部申请开通。</div>
                    <div class="system_tip f14"><span class="Tip_ico"></span><span class="Tip_content">内部公告：系统将于2013-02-26</span></div>
                    <div class="admin_online">当前在线工作人员：</div>
                    <div class="admin_name">
                        <?php if(is_array($adminlist)): $i = 0; $__LIST__ = $adminlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="blkBreadcrumbNav"><span class="blkBreadcrumbNav_ico"></span>管理系统开发团队</div>
                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <tr class="bg">
                            <td width="20%">公司名称：</td>
                            <td><b>昆明婴格经贸有限公司</b></td>
                        </tr>
                        <tr>
                            <td>总策划兼项目经理：</td>
                            <td>董&nbsp;&nbsp;浩</td>
                        </tr>
                        <tr class="bg">
                            <td>产品设计与研发团队：</td>
                            <td>董&nbsp;&nbsp;浩&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;马&nbsp;&nbsp;祥</td>
                        </tr>
                        <tr>
                            <td>公司网站：</td>
                            <td><a href="http://www.yinggebaby.com">www.yinggebaby.com</a></td>
                        </tr>
                        <tr class="bg">
                            <td>系统网站</td>
                            <td><a href="http://www.dmibox.com">www.dmibox.com</a></td>
                        </tr>
                    </table>
                </div>
                <!-- } Content End -->
                <!-- Footer Start { -->
                <div class="footer">Powered by Dmibox 版权所有 © 2013 迪米盒子网络科技有限公司，并保留所有权利。</div>
                <!-- } Footer End -->
            </div>
            <!-- } Main End -->
        </div>
        <!-- } Body End -->
    </body>
</html>