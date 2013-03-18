<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/style.css" />
<!-- Top Start { -->
        <div class="head">
            <div class="logo"><a href="javascript:void(0)" onclick="changePage('__APP__/Index-system_left','__APP__/Index-main',this)" target="win" class="txt_fff">婴格经贸有限公司管理系统</a></div>
            <div class="system">
                <ul>
                    <li><a href="javascript:void(0)" onclick="changePage('__APP__/Index-left','__APP__/Goods-orderList',this)" target="win">商品智能补货系统</a></li>
                    <li><a href="#">订单登记管理系统</a></li>
                </ul>
            </div>
        </div>
<!-- } Top End -->
<script>
function changePage(url1,url2,obj){

	parent.leftframe.window.location.href=url1;
	parent.win.window.location.href=url2;
	
	/*
         * 
         var oMenu = document.getElementById('menu_list').getElementsByTagName('a');
	for(i=0;i<oMenu.length;i++){
		oMenu[i].className='';
	}
	obj.className="focus";	*/

}
</script>