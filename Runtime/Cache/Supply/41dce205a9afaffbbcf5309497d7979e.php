<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/style.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/system.css" />
<!-- Left Start { -->
            <div class="main_left">
                <div class="admininfo">
                    <p>欢迎您：<?php echo ($_SESSION['loginUserName']); ?></p>
                    <p>隶属部门：<?php echo ($_SESSION['department']); ?></p>
                    <p><a href="__APP__/Index-changePwd">修改密码</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Login-unlogin">退出系统</a></p>
                </div>
                <div class="system_menu">
                    <h2>系统全局管理</h2>
                    <ul id="left_menu">
                        <li><a href="__APP__/Index-main" class="hover" target='win'>系统首页</a></li>
                        <li><a href="__APP__/Admin-adminList" target="win">管理团队设置</a></li>
                        <li><a href="">数据库管理</a></li>
                    </ul>
                </div>
                <div class="system_info">
                    <h2>服务器信息</h2>
                    <ul>
                        <li>服务器系统：<br /><span><?php echo ($info['操作系统']); ?></span></li>
                        <li>服务器环境：<br /><span><?php echo ($info['运行环境']); ?></span></li>
                        <li>ThinkPHP版本：<br /><span><?php echo ($info['ThinkPHP版本']); ?></span></li>
                        <li>服务器时间：<br /><span><?php echo ($info['服务器时间']); ?></span></li>
                        <li>剩余空间：<br /><span><?php echo ($info['剩余空间']); ?></span></li>
                    </ul>
                </div>
            </div>
<!-- } Left End -->
<script type="text/ecmascript">
var oLeftMenu = document.getElementById('left_menu').getElementsByTagName('a');
for(i=0;i<oLeftMenu.length;i++){
	oLeftMenu.item(i).onclick = function(){
		if(this.className == ""){
			for(o=0;o<oLeftMenu.length;o++){
				oLeftMenu.item(o).className="";
			}
			this.className = "hover";
		}
	}
}
</script>