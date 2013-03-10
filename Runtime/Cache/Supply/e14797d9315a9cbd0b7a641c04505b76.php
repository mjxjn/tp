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
        <script language="javascript" type="text/javascript" src="__PUBLIC__/Js/jquery.core.js"></script>
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
                    <h2>商品智能补货系统</h2>
                    <ul>
                        <li><a href="__APP__/Goods-orderList">商品订单类表</a></li>
                        <li><a href="__APP__/Goods-upGoodsList" class="hover">上传商品清单</a></li>
                        <li><a href="">供货商管理</a></li>
                        <li><a href="">采购单管理</a></li>
                    </ul>
                </div>
            </div>
            <!-- } Left End -->
            <!-- Main Start { -->
            <div class="main">
                <!-- Content Start { -->
                <div class="content">
                    <!-- 路径导航 Start ｛ -->
                    <div class="blkBreadcrumbNav txt_636363"><span class="blkBreadcrumbNav_ico"></span><a href="__APP__">管理中心</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="__APP__/Goods-orderList">商品智能补货系统</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;上传商品清单</div>
                    <!-- } 路径导航 End -->
                    
                    <div class="system_note">批量导入商品信息需下载数据模板填写并上传，上传完毕后系统会自动分配一个单号给上传的订单，可以在商品订单列表查看，建议文件大小不超过5MB</div>
                    <div class="download_csv">
                        <h2>第一步&nbsp;下载数据模板（csv文件）：</h2>
                        <div class="">
                            <div class="left w350 info_bg">
                                <span class="down_ico"></span><a href="__PUBLIC__/Csv/orderList.csv">下载数据模板</a>
                            </div>
                            <div class="left">
                                数据模板格式为csv文件，使用Excel表格打开并填写商品信息
                            </div>
                        </div>
                        <div class="clear"></div>
                        <a href="__PUBLIC__/Csv/orderList.csv" class="download_btn"></a>
                    </div>
                    <div class="clear"></div>
                    <div class="upload_csv">
                        <h2>第二步&nbsp;上传数据模板（csv文件）：</h2>
                        <form action="__APP__/Goods-csvUpload" name="upload" method="post" enctype="multipart/form-data">
                        <div class="">
<!--                            <div class="left w350 info_bg">
                                <span class="up_ico"></span>上传数据模板
                            </div>-->
                            <div class="left w350">
                                <input type="file" name="upfile" />
                            </div>
                            <div class="left">
                                上传填写完毕的商品信息数据模板，完成数据批量导入
                            </div>
                        </div>
                        <div class="clear"></div>
                        <input type="submit" class="upload_btn" value="开始导入"/>
                        </form>
                    </div>
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