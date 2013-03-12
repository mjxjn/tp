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
                        <li><a href="__APP__/Goods-orderList" class="hover">商品订单类表</a></li>
                        <li><a href="__APP__/Goods-upGoodsList">上传商品清单</a></li>
                        <li><a href="__APP__/Supplier-supplier">供货商管理</a></li>
                        <li><a href="__APP__/Purchase-purchase">采购单管理</a></li>
                    </ul>
                </div>
            </div>
            <!-- } Left End -->
            <!-- Main Start { -->
            <div class="main">
                <!-- Content Start { -->
                <div class="content">
                    <!-- 路径导航 Start ｛ -->
                    <div class="blkBreadcrumbNav txt_636363"><span class="blkBreadcrumbNav_ico"></span><a href="__APP__">管理中心</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="__APP__/Goods-orderList">商品智能补货系统</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;商品订单列表</div>
                    <!-- } 路径导航 End -->
                    
                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <thead>
                            <tr class="table_top">
                                <td colspan="5">商品订单列表</td>
                                <td class="table_action"><span class="table_action_ico"></span><a href="__APP__/Goods-upGoodsList">上传商品清单</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg table_menu">
                                <td width="10%"><input type="checkbox" name="" value="" /></td>
                                <td width="20%" align="center">单号</td>
                                <td width="10%" align="center">商品数量</td>
                                <td width="20%" align="center">上传日期</td>
                                <td width="20%" align="center">操作人</td>
                                <td width="20%" align="center">操作</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?>>
                                <td width="10%"><input type="checkbox" name="" value="<?php echo ($vo["id"]); ?>" /></td>
                                <td width="20%" align="center"><?php echo ($vo["oid"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["goods_num"]); ?></td>
                                <td width="20%" align="center"><?php echo ($vo["cre_time"]); ?></td>
                                <td width="20%" align="center"><?php echo ($vo["name"]); ?></td>
                                <td width="20%" align="center"><a href="__APP__/Goods-goodsList-id-<?php echo ($vo["id"]); ?>">查看</a>&nbsp;&nbsp;<?php if(($vo["flag"]) == "1"): ?><a href="__APP__/Purchase-creatPurchase-id-<?php echo ($vo["id"]); ?>">生成采购单</a><?php else: ?>已生成采购单<?php endif; ?>&nbsp;&nbsp;<a href="__APP__/Goods-goodsDel-id-<?php echo ($vo["id"]); ?>" onclick="javascript:return p_del();">删除</a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="6"><?php echo ($page); ?></td>
                            </tr>
                        </tbody>
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
<SCRIPT LANGUAGE=javascript>

function p_del() {
var msg = "您真的确定要删除吗？\n\n请确认！";
if (confirm(msg)==true){
return true;
}else{
return false;
}
}

</SCRIPT>