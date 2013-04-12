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
                    <div class="searchSupplier" style="margin-top: 10px">
                        <form action="__APP__/Purchase-findSupplier" method="post" name="form2" id="form2">
                            供货商名称/供货商编号:&nbsp;&nbsp;<input type="text" id="supplier" name="supplier" value="供货商名称/供货商编号" onclick="clearDefaultText(this,'供货商名称/供货商编号')" style="height:24px; line-height: 24px; width: 250px"/>
                                    <input type="button" name="button" value='搜索供货商' onclick="findSupplier()" class="alldel"  />
                                    
                                    <select name="sid" id="supplierId">
                                        <option value=""></option>
                                    </select>
                                    <input type="submit" name="button" value='查看' class="alldel"  />
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Purchase-purchase">查看所有采购单</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Purchase-purchase-type-1">仅查看总仓采购单</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Purchase-purchase-type-2">仅查看和谐仓采购单</a>
                       </form>
                    </div>
                    <form action="__APP__/Purchase-allAct" method="post" name="form1" id="form1">
                    <table cellpadding="0" cellspacing="0" class="tablebox" width="100%" >
                        <thead>
                            <tr class="table_top">
                                <td colspan="8">采购单据列表</td>
                                <td class="table_action" colspan="2"><span class="table_action_ico"></span><a href="__APP__/Goods-upGoodsList">批量添加商品</a>&nbsp;&nbsp;<span class="table_action_ico"></span><a href="__APP__/Goods-upGoodsList">添加供货商品</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg table_menu">
                                <td width="5%"><input type="checkbox" name="checkall" id="chk_all"  value="" /></td>
                                <td width="10%" align="center">单号</td>
                                <td width="10%" align="center">供货仓库</td>
                                <td width="20%" align="center">供货商名称</td>
                                <td width="5%" align="center">供货商品数量</td>
                                <td width="15%" align="center">生成日期</td>
                                <td width="10%" align="center">到货状况</td>
                                <td width="10%" align="center">到货商品</td>
                                <td width="15%" align="center">操作</td>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>bg<?php endif; ?>>
                                <td width="5%"><input type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>" /></td>
                                <td width="10%" align="center"><?php echo ($vo["oid"]); ?></td>
                                <td width="10%" align="left"><?php echo ($vo["Warehouse"]); ?></td>
                                <td width="20%" align="left" title="<?php echo ($vo["supplier"]); ?>"><?php echo ($vo["supplier"]); ?></td>
                                <td width="5%" align="center"><?php echo ($vo["goods_num"]); ?></td>
                                <td width="15%" align="center"><?php echo ($vo["cre_time"]); ?></td>
                                <td width="10%" align="left"><?php if(($vo["state"]) == "1"): ?>未到货<?php else: ?>已到货<?php endif; ?></td>
                                <td width="10%" align="center"><a href='__APP__/Purchase-upPurchase-id-<?php echo ($vo["id"]); ?>-sid-<?php echo ($vo["sid"]); ?>'>导入</a></td>
                                <td width="15%" align="center"><a href="__APP__/Purchase-purchaseList-id-<?php echo ($vo["id"]); ?>-sid-<?php echo ($vo["sid"]); ?>">查看</a>&nbsp;&nbsp;<a href="__APP__/Purchase-excelPurchase-id-<?php echo ($vo["id"]); ?>-sid-<?php echo ($vo["sid"]); ?>">导出(<?php echo ($vo["count"]); ?>)</a>&nbsp;&nbsp;<a href="__APP__/Purchase-purchaseDel-id-<?php echo ($vo["id"]); ?>" onclick="javascript:return p_del();">删除</a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="2"><input type="button" name="delete" value='删除' onclick="all_del()" class="alldel"  /><input type="button" name="dao" value='导出' onclick="all_save()" class="alldel"  /><input type="hidden" name="act" value="" /></td>
                                <td colspan="7" align="right" class="manu"><?php echo ($page); ?></td>
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
function clearDefaultText (el,message)
    {
    var obj = el;
    if(typeof(el) == "string")
    obj = document.getElementById(id);
    if(obj.value == message)
    {
    obj.value = "";
    }
    obj.onblur = function()
    {
    if(obj.value == "")
    {
       obj.value = message;
    }
    }
    }
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
                                                $("input[name='act']").attr("value",'del');
                                                document.form1.submit();
                                            } else {
                                                return false;
                                            }
                                        }
                                        function all_save(){
                                            var msg = "您真的确定要导出选中信息吗？\n\n请确认！";
                                            if (confirm(msg) == true) {
                                                $("input[name='act']").attr("value",'dao');
                                                $("input[name='ids[]']").each(function() {
                                                    if ($(this).attr("checked")) {  
                                                        //alert($(this).val());
                                                        window.open('__APP__/Purchase-allExcelPurchase-id-'+$(this).val());
                                                    }  
                                                });  
                                                 
                                                //document.form1.submit();
                                            } else {
                                                return false;
                                            }
                                        }
                                        
                                        function findSupplier(){
                                            var keyword = $('#supplier').val();
                                            
                                            $("#supplierId").empty();
                                            $.ajax({
            type: "POST",
            url: "__APP__/Supplier-getSupplierList",
            data: "keyword="+keyword,
            dataType: "json",
            success : function(msg){
                if(msg.state==1){
                    var i=1
				    while(i!=0){
				      if(msg[i-1]!=undefined){
				    	  $('#supplierId').append("<option value='"+msg[i-1].sid+"'>"+msg[i-1].supplier+"</option>");
				          i++;
				      }else{
				         i=0;
				      }
				   } 
                }else{
                  alert('没有搜索到信息！');
                }
              }
          });
                                        }
</SCRIPT>