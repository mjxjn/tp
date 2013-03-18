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
                    <div class="blkBreadcrumbNav txt_636363"><span class="blkBreadcrumbNav_ico"></span><a href="__APP__">管理中心</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="__APP__/Goods-orderList">商品智能补货系统</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;采购单据列表</div>
                    <!-- } 路径导航 End -->
                    
                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <thead>
                            <tr class="table_top">
                                <td colspan="8">采购单据列表</td>
                                <td class="table_action" colspan="2"><span class="table_action_ico"></span><a href="__APP__/Goods-upGoodsList">批量添加商品</a>&nbsp;&nbsp;<span class="table_action_ico"></span><a href="__APP__/Goods-upGoodsList">添加供货商品</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg table_menu">
                                <td width="5%"><input type="checkbox" name="" value="" /></td>
                                <td width="10%" align="center">供货商编号</td>
                                <td width="10%" align="center">供货仓库</td>
                                <td width="20%" align="center">供货商名称</td>
                                <td width="5%" align="center">供货商品数量</td>
                                <td width="15%" align="center">生成日期</td>
                                <td width="10%" align="center">到货状况</td>
                                <td width="10%" align="center">到货商品</td>
                                <td width="15%" align="center">操作</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?>>
                                <td width="5%"><input type="checkbox" name="" value="<?php echo ($vo["id"]); ?>" /></td>
                                <td width="10%" align="center"><?php echo ($vo["sid"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["Warehouse"]); ?></td>
                                <td width="20%" align="center" title="<?php echo ($vo["supplier"]); ?>"><?php echo ($vo["supplier"]); ?></td>
                                <td width="5%" align="center"><?php echo ($vo["goods_num"]); ?></td>
                                <td width="15%" align="center"><?php echo ($vo["cre_time"]); ?></td>
                                <td width="10%" align="center"><?php if(($vo["state"]) == "1"): ?>未到货<?php else: ?>已到货<?php endif; ?></td>
                                <td width="10%" align="center"><a href='__APP__/Purchase-upPurchase-id-<?php echo ($vo["id"]); ?>-sid-<?php echo ($vo["sid"]); ?>'>导入</a></td>
                                <td width="15%" align="center"><a href="__APP__/Purchase-purchaseList-id-<?php echo ($vo["id"]); ?>-sid-<?php echo ($vo["sid"]); ?>">查看</a>&nbsp;&nbsp;<a href="__APP__/Purchase-excelPurchase-id-<?php echo ($vo["id"]); ?>-sid-<?php echo ($vo["sid"]); ?>">导出</a>&nbsp;&nbsp;<a href="__APP__/Purchase-purchaseDel-id-<?php echo ($vo["id"]); ?>" onclick="javascript:return p_del();">删除</a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="9"><?php echo ($page); ?></td>
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