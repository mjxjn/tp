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
                    <form action="__APP__/Supplier-allDel" method="post" name="form2" id="form2">
                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <thead>
                            <tr class="table_top">
                                <td colspan="8">供货商列表</td>
                                <td class="table_action"><span class="table_action_ico"></span><a href="#" onclick="javascript:addsupplier();">添加新供货商</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg table_menu">
                                <td width="5%"><input type="checkbox" name="checkall" id="chk_all"  value="" /></td>
                                <td width="10%" align="center">供货商编号</td>
                                <td width="10%" align="center">供货商名称</td>
                                <td width="20%" align="center">联系人</td>
                                <td width="10%" align="center">手机</td>
                                <td width="10%" align="center">地址</td>
                                <td width="10%" align="center">座机</td>
                                <td width="10%" align="center">传真</td>
                                <td width="15%" align="center">操作</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?>>
                                    <td width="5%"><input type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>-<?php echo ($vo["sid"]); ?>" /></td>
                                    <td width="10%" align="center"><?php echo ($vo["sid"]); ?></td>
                                    <td width="10%" align="left" title="<?php echo ($vo["supplier"]); ?>"><?php echo ($vo["supplier"]); ?></td>
                                    <td width="20%" align="left"><?php echo ($vo["name"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["phone"]); ?></td>
                                    <td width="10%" align="left" title="<?php echo ($vo["address"]); ?>"><?php echo ($vo["address"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["tel"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["fax"]); ?></td>
                                    <td width="15%" align="center"><a href="#" onclick="javascript:editSupplier('<?php echo ($vo["id"]); ?>');">编辑</a>&nbsp;&nbsp;<a href="__APP__/Supplier-supplierGoods-sid-<?php echo ($vo["sid"]); ?>">商品</a>&nbsp;&nbsp;<a href="__APP__/Supplier-supplierDel-id-<?php echo ($vo["id"]); ?>-sid-<?php echo ($vo["sid"]); ?>" onclick="javascript:return p_del();">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="2"><input type="button" name="delete" value='删除' onclick="all_del()" class="alldel"  /></td>
                                <td colspan="7" align="right" class="manu"><?php echo ($page); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
                <!-- } Content End -->
                <!-- AddSupplier Start { -->
                <div class="addsupplier">
                    <div class="addsupplier_title"><a href="#" onclick="javascript:closesupplier();" class="closesupplier"></a></div>
                    <form action="__APP__/Supplier-addsupplier" method="post" name="form1" id="form1">
                        <table border="0" cellpadding="0" cellspacing="0" class="supplytable">
                            <tr>
                                <td colspan="2"><b>供货商名称设置</b></td>
                            </tr>
                            <tr>
                                <td width="200"><input type="text" class="inputtxt" name="supplier" value="" /></td>
                                <td>设置当前供货商名称</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>供货商编号设置</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="sid" value="" /></td>
                                <td>设置供货商编号，编号不可重复</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>供货商联系人</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="name" value="" /></td>
                                <td>设置供货商联系人姓名</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>供货商联系人手机</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="phone" value="" /></td>
                                <td>设置供货商联系人手机，手机号和座机号必须一项</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>供货商座机号</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="tel" value="" /></td>
                                <td>设置供货商座机号，手机号和座机号必须一项</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>供货商传真号</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="fax" value="" /></td>
                                <td>设置供货商传真号，选填</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>供货商地址</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="inputtxt" name="address" value="" /></td>
                                <td>设置供货商详细地址</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" class="inputbtn" name="submit" value="保存" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="javascript:closesupplier();" name="button" value="取消" class="inputbtn" /><input type="hidden" name="act" value="add" /><input type="hidden" name="id" value="" /></td>
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

                                    function addsupplier() {
                                        $('.addsupplier').show();
                                    }
                                    function closesupplier() {
                                        $('.addsupplier').hide();
                                    }
                                    function editSupplier(id) {
                                        $.ajax({
                                            type: "POST",
                                            url: "__APP__/Supplier-AjaxGetSupplierInfo",
                                            data: "id="+id,
                                            dataType: 'json',
                                            success: function(msg) {
                                                if(msg['state']===1){
                                                    alert("参数错误！");
                                                }else{
                                                    $("input[name='id']").attr('value',msg['info']['id']);
                                                    $("input[name='supplier']").attr('value',msg['info']['supplier']);
                                                    $("input[name='sid']").attr('value',msg['info']['sid']);
                                                    $("input[name='name']").attr('value',msg['info']['name']);
                                                    $("input[name='phone']").attr('value',msg['info']['phone']);
                                                    $("input[name='tel']").attr('value',msg['info']['tel']);
                                                    $("input[name='fax']").attr('value',msg['info']['fax']);
                                                    $("input[name='address']").attr('value',msg['info']['address']);
                                                    $("input[name='act']").attr('value','save');
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
$("#chk_all").click(function() {
                                            $("input[name='ids[]']").attr("checked", $(this).attr("checked"));
                                        });
                                        function all_del() {
                                            var msg = "您真的确定要删除选中信息吗？\n\n请确认！";
                                            if (confirm(msg) == true) {
                                                document.form2.submit();
                                            } else {
                                                return false;
                                            }
                                        }
</SCRIPT>