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
                                <td colspan="5">采购数量：<?php echo ($count); ?>&nbsp;&nbsp;实际到货商品数量：<?php echo ($getcount); ?>&nbsp;&nbsp;到货率：<?php echo ($getbai); ?>%</td>
                                <td colspan="6" align="right"><a href="__APP__/Purchase-purchaseList-id-<?php echo ($id); ?>-sid-<?php echo ($sid); ?>">全部商品列表</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Purchase-purchaseList-id-<?php echo ($id); ?>-sid-<?php echo ($sid); ?>-state-1">全部到货商品</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Purchase-purchaseList-id-<?php echo ($id); ?>-sid-<?php echo ($sid); ?>-state-2">未完全到货商品</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Purchase-purchaseList-id-<?php echo ($id); ?>-sid-<?php echo ($sid); ?>-state-3">超出到货数量商品</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Purchase-purchaseList-id-<?php echo ($id); ?>-sid-<?php echo ($sid); ?>-state-4">未采购商品</a></td>
                            </tr>
                            <tr class="table_top">
                                <td colspan="11">仓库：<?php echo ($Warehouse); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供货商：<?php echo ($supplier); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;生成日期：<?php echo ($cre_time); ?></td>
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
                                <td width="10%" align="center">商品陈列</td>
                                <td width="10%" align="center">装箱数量</td>
                                <td width="10%" align="center">供货商</td>
                                <td width="5%" align="center">补货数量</td>
                                <td width="5%" align="center">到货情况</td>
                                <td width="5%" align="center">操作</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?> <?php if($vo["state"] == 2): ?>class="red"<?php endif; ?>>
                                <td width="5%"><input type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>" /></td>
                                <td width="10%" align="center"><?php echo ($vo["goods_code"]); ?></td>
                                <td width="10%" align="left" title="<?php echo ($vo["goods_name"]); ?>"><?php echo ($vo["goods_name"]); ?></td>
                                <td width="20%" align="center"><?php echo ($vo["specification"]); ?></td>
                                <td width="10%" align="center" title="<?php echo ($vo["marque"]); ?>"><?php echo ($vo["marque"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["display"]); ?></td>
                                <td width="10%" align="center"><?php echo ($vo["box_num"]); ?></td>
                                <td width="10%" align="left"><?php echo ($supplier); ?></td>
                                <td width="5%" align="center"><?php echo ($vo["goods_num"]); if($vo["source_goods_num"] != '0'): ?><font color='red'>[<?php echo ($vo["source_goods_num"]); ?>]</font><?php endif; ?></td>
                                <td width="5%" align="center">
                                    <?php if($vo['get_goods_num'] == $vo['goods_num']): ?><span class="ok"></span>
                                    <?php elseif($vo['get_goods_num'] < $vo['goods_num']): ?>
                                        <?php echo ($vo["get_goods_num"]); ?>
                                    <?php else: ?>
                                        <font color="red"><?php echo ($vo["get_goods_num"]); ?></font><?php endif; ?>
                                </td>
                                <td width="5%" align="center"><a href="#" onclick="javascript:editPurchase('<?php echo ($vo["id"]); ?>');">修改补货</a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="2"><input type="button" name="delete" value='删除' onclick="all_del()" class="alldel"  /></td>
                                <td colspan="9" align="right" class="manu"><?php echo ($page); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
                <!-- } Content End -->
                <div class="addsupplier">
                    <div class="addsupplier_title"><a href="#" onclick="javascript:closesupplier();" class="closesupplier"></a></div>
                    <form action="__APP__/Purchase-editGoodsNum" method="post" name="form1" id="form1">
                        <table border="0" cellpadding="0" cellspacing="0" class="supplytable">
                            <tr>
                                <td colspan="2"><b>修改补货数量</b></td>
                            </tr>
                            <tr>
                                <td width="200"><input type="text" class="inputtxt" name="goods_num" value="" /></td>
                                <td>设置当前商品补货数量</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="inputbtn" name="submit" value="保存" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="javascript:closesupplier();" name="button" value="取消" class="inputbtn" /><input type="hidden" name="act" value="edit" /><input type="hidden" name="id" value="" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
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
                                        function closesupplier() {
                                            $('.addsupplier').hide();
                                        }
                                        function editPurchase(id) {
                                        $.ajax({
                                            type: "POST",
                                            url: "__APP__/Purchase-AjaxGetPurchaseInfo",
                                            data: "id="+id,
                                            dataType: 'json',
                                            success: function(msg) {
                                                if(msg['state']===1){
                                                    alert("参数错误！");
                                                }else{
                                                    $("input[name='id']").attr('value',id);
                                                    $("input[name='goods_num']").attr('value',msg['info']['goods_num']);
                                                    $('.addsupplier').show();
                                                }
                                            }
                                        });
                                    }
var _move=false;//移动标记
var _x,_y;//鼠标离控件左上角的相对位置
$(document).ready(function(){
    $(".addsupplier_title").click(function(){
        //alert("click");//点击（松开后触发）
        }).mousedown(function(e){
        _move=true;
        _x=e.pageX-parseInt($(".addsupplier").css("left"));
        _y=e.pageY-parseInt($(".addsupplier").css("top"));
        $(".addsupplier").fadeTo(20, 0.25);//点击后开始拖动并透明显示
    });
    $(document).mousemove(function(e){
        if(_move){
            var x=e.pageX-_x;//移动时根据鼠标位置计算控件左上角的绝对位置
            var y=e.pageY-_y;
            $(".addsupplier").css({top:y,left:x});//控件新位置
        }
    }).mouseup(function(){
    _move=false;
    $(".addsupplier").fadeTo("fast", 1);//松开鼠标后停止移动并恢复成不透明
  });
});
</SCRIPT>