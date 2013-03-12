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
                        <li><a href="__APP__/Goods-orderList">商品订单类表</a></li>
                        <li><a href="__APP__/Goods-upGoodsList">上传商品清单</a></li>
                        <li><a href="__APP__/Supplier-supplier" class="hover">供货商管理</a></li>
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
                    <div class="blkBreadcrumbNav txt_636363"><span class="blkBreadcrumbNav_ico"></span><a href="__APP__">管理中心</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="__APP__/Goods-orderList">商品智能补货系统</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;供货商管理</div>
                    <!-- } 路径导航 End -->

                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <thead>
                            <tr class="table_top">
                                <td colspan="8">供货商:<?php echo ($info['supplier']); ?></td>
                                <td class="table_action"><span class="table_action_ico"></span><a href="__APP__/Supplier-upSupplier">批量添加商品</a>&nbsp;&nbsp;&nbsp;&nbsp;<span class="table_action_ico"></span><a href="#" onclick="javascript:addsupplier();">添加供货商品</a></td>
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
                                    <td width="20%" align="center"><?php echo ($vo["goods_name"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["specification"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["marque"]); ?></td>
                                    <td width="10%" align="center"><?php echo ($vo["box_num"]); ?></td>
                                    <td width="15%" align="center"><a href="#" onclick="javascript:editSupplier('<?php echo ($vo["id"]); ?>');">编辑</a>&nbsp;&nbsp;<a href="__APP__/Supplier-supplierGoodsDel-id-<?php echo ($vo["id"]); ?>" onclick="javascript:return p_del();">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="9"><?php echo ($page); ?></td>
                            </tr>
                        </tbody>
                    </table>
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
</SCRIPT>