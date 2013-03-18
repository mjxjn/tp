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
                    <div class="blkBreadcrumbNav txt_636363"><span class="blkBreadcrumbNav_ico"></span><a href="__APP__">管理中心</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="__APP__/Goods-orderList">商品智能补货系统</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;供货商管理</div>
                    <!-- } 路径导航 End -->

                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <thead>
                            <tr class="table_top">
                                <td colspan="7">供货商:<?php echo ($info['supplier']); ?></td>
                                <td class="table_action" colspan="2"><span class="table_action_ico"></span><a href="__APP__/Supplier-upSupplier-sid-<?php echo ($info['sid']); ?>">批量添加商品</a>&nbsp;&nbsp;&nbsp;&nbsp;<span class="table_action_ico"></span><a href="#" onclick="javascript:addsupplier();">添加供货商品</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg table_menu">
                                <td width="5%"><input type="checkbox" name="" value="" /></td>
                                <td width="10%" align="center">供货商编号</td>
                                <td width="20%" align="center">商品条码</td>
                                <td width="20%" align="center">商品名称</td>
                                <td width="10%" align="center">商品规格</td>
                                <td width="10%" align="center">商品型号</td>
                                <td width="10%" align="center">装箱数量</td>
                                <td width="15%" align="center">操作</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?>>
                                    <td width="5%"><input type="checkbox" name="" value="<?php echo ($vo["id"]); ?>" /></td>
                                    <td width="10%" align="center"><?php echo ($vo["sid"]); ?></td>
                                    <td width="20%" align="center"><?php echo ($vo["goods_code"]); ?></td>
                                    <td width="20%" align="center" title="<?php echo ($vo["goods_name"]); ?>"><?php echo ($vo["goods_name"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["specification"]); ?></td>
                                    <td width="10%" align="center" title="<?php echo ($vo["marque"]); ?>"><?php echo ($vo["marque"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["box_num"]); ?></td>
                                    <td width="15%" align="center"><a href="#" onclick="javascript:editSupplierGoods('<?php echo ($vo["id"]); ?>');">编辑</a>&nbsp;&nbsp;<a href="__APP__/Supplier-supplierGoodsDel-id-<?php echo ($vo["id"]); ?>" onclick="javascript:return p_del();">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="8"><?php echo ($page); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- } Content End -->
                <!-- AddSupplier Start { -->
                <div class="addsupplier">
                    <div class="addsupplier_title"><a href="#" onclick="javascript:closesupplier();" class="closesupplier"></a></div>
                    <form action="__APP__/Supplier-saveSupplierGoods" method="post" name="form1" id="form1">
                        <table border="0" cellpadding="0" cellspacing="0" class="supplytable">
                            <tr>
                                <td colspan="2"><b>供货商编号</b></td>
                            </tr>
                            <tr>
                                <td width="200"><input type="text" class="inputtxt" name="sid" value="" /></td>
                                <td>设置当前供货商名称</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>商品条码</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="goods_code" value="" /></td>
                                <td>设置供货商编号，编号不可重复</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>商品名称</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="goods_name" value="" /></td>
                                <td>设置供货商联系人姓名</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>商品规格</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="specification" value="" /></td>
                                <td>设置供货商联系人手机，手机号和座机号必须一项</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>商品型号</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="marque" value="" /></td>
                                <td>设置供货商座机号，手机号和座机号必须一项</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>装箱数量 </b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="box_num" value="" /></td>
                                <td>设置供货商传真号，选填</td>
                            </tr>
                            <tr>
                                <td colspan="2" width="620" align="center"><input type="submit" class="inputbtn" name="submit" value="保存" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="javascript:closesupplier();" name="button" value="取消" class="inputbtn" /><input type="hidden" name="id" value="" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- } AddSupplier End -->
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
                                        if (confirm(msg) == true) {
                                            return true;
                                        } else {
                                            return false;
                                        }
                                    }
                                    
                                    function closesupplier(){
                                        $('.addsupplier').hide();
                                    }

                                    function editSupplierGoods(id) {
                                        $.ajax({
                                            type: "POST",
                                            url: "__APP__/Supplier-AjaxGetSupplierGoods",
                                            data: "id="+id,
                                            dataType: 'json',
                                            success: function(msg) {
                                                if(msg['state']===1){
                                                    alert("参数错误！");
                                                }else{
                                                    $("input[name='sid']").attr('value',msg['info']['sid']);
                                                    $("input[name='goods_code']").attr('value',msg['info']['goods_code']);
                                                    $("input[name='goods_name']").attr('value',msg['info']['goods_name']);
                                                    $("input[name='specification']").attr('value',msg['info']['specification']);
                                                    $("input[name='marque']").attr('value',msg['info']['marque']);
                                                    $("input[name='box_num']").attr('value',msg['info']['box_num']);
                                                    $("input[name='id']").attr('value',id);
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