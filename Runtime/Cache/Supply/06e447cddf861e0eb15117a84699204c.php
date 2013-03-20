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
                    <div class="blkBreadcrumbNav txt_636363"><span class="blkBreadcrumbNav_ico"></span><a href="__APP__">管理中心</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="__APP__/Goods-orderList">商品智能补货系统</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;采购单据管理</div>
                    <!-- } 路径导航 End -->
                    <form action="__APP__/Purchase-allListDel" method="post" name="form1" id="form1">
                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <thead>
                            <tr class="table_top">
                                <td colspan="10">仓库：<?php echo ($Warehouse); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供货商：<?php echo ($supplier); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;生成日期：<?php echo ($cre_time); ?></td>
<!--                                <td class="table_action" colspan="3">
                                    
                                </td>-->
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg table_menu">
                                <td width="5%"><input type="checkbox" name="checkall" id="chk_all"  value="" /></td>
                                <td width="10%" align="center">商品条码</td>
                                <td width="10%" align="center">商品名称</td>
                                <td width="20%" align="center">商品规格</td>
                                <td width="10%" align="center">商品型号</td>
                                <td width="15%" align="center">商品陈列</td>
                                <td width="10%" align="center">装箱数量</td>
                                <td width="10%" align="center">供货商</td>
                                <td width="5%" align="center">补货数量</td>
                                <td width="5%" align="center">到货情况</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?> <?php if($vo["state"] == 2): ?>class="red"<?php endif; ?>>
                                <td width="5%"><input type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>" /></td>
                                <td width="10%" align="center"><?php echo ($vo["goods_code"]); ?></td>
                                <td width="10%" align="center" title="<?php echo ($vo["goods_name"]); ?>"><?php echo ($vo["goods_name"]); ?></td>
                                <td width="20%" align="center"><?php echo ($vo["specification"]); ?></td>
                                <td width="10%" align="center" title="<?php echo ($vo["marque"]); ?>"><?php echo ($vo["marque"]); ?></td>
                                <td width="15%" align="center"><?php echo ($vo["display"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["box_num"]); ?></td>
                                <td width="10%" align="center"><?php echo ($supplier); ?></td>
                                <td width="5%" align="center"><?php echo ($vo["goods_num"]); ?></td>
                                <td width="5%" align="center">
                                    <?php if($vo['get_goods_num'] == $vo['goods_num']): ?><span class="ok"></span>
                                    <?php elseif($vo['get_goods_num'] < $vo['goods_num']): ?>
                                        <?php echo ($vo["get_goods_num"]); ?>
                                    <?php else: ?>
                                        <font color="red"><?php echo ($vo["get_goods_num"]); ?></font><?php endif; ?>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="2"><input type="button" name="delete" value='删除' onclick="all_del()" class="alldel"  /></td>
                                <td colspan="8"><?php echo ($page); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
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
$("#chk_all").click(function() {
                                            $("input[name='ids[]']").attr("checked", $(this).attr("checked"));
                                        });
                                        function all_del() {
                                            var msg = "您真的确定要删除选中信息吗？\n\n请确认！";
                                            if (confirm(msg) == true) {
                                                document.form1.submit();
                                            } else {
                                                return false;
                                            }
                                        }
</SCRIPT>