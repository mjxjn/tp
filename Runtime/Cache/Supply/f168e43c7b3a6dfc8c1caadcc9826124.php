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
        
        <!-- Body Start { -->
        <div class="body">
            
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
                                <td colspan="9">单号：<?php echo ($info["oid"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上传日期：<?php echo ($info["cre_time"]); ?></td>
                                <td colspan="1" class="table_action">
                                    <form action="__APP__/Goods-search" name="form1" method="post">
                                        <input type="text" name="keyword" value="" class="search" />
                                        <input type="submit" name="submit" value="搜索" class="search_btn" />
                                    </form>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg table_menu">
                                <td width="5%"><input type="checkbox" name="" value="" /></td>
                                <td width="10%" align="center">商品条码</td>
                                <td width="15%" align="center">商品名称</td>
                                <td width="10%" align="center">商品规格</td>
                                <td width="10%" align="center">商品型号</td>
                                <td width="10%" align="center">商品陈列</td>
                                <td width="10%" align="center">装箱数量</td>
                                <td width="10%" align="center">供货商</td>
                                <td width="10%" align="center">总仓补货</td>
                                <td width="10%" align="center">和谐补货</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?>>
                                <td width="5%"><input type="checkbox" name="" value="<?php echo ($vo["id"]); ?>" /></td>
                                <td width="10%" align="center"><?php echo ($vo["goods_code"]); ?></td>
                                <td width="15%" align="center" title="<?php echo ($vo["goods_name"]); ?>"><?php echo ($vo["goods_name"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["specification"]); ?></td>
                                <td width="10%" align="center" title="<?php echo ($vo["marque"]); ?>"><?php echo ($vo["marque"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["display"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["box_num"]); ?></td>
                                <td width="10%" align="center"><?php if(($vo["supplier"]) == ""): ?>-<?php else: echo ($vo["supplier"]); endif; ?></td>
                                <td width="10%" align="center"><?php echo ($vo["center"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["accord"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="10"><?php echo ($page); ?></td>
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