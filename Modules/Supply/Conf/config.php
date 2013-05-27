<?php
return array(
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  'localhost',
    'DB_NAME'                   =>  'reshop',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  '',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'rs_',
    
    'USER_AUTH_ON'              =>  TRUE, //设置权限验证
    'USER_AUTH_TYPE'            =>  2,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'user',
    'ADMIN_AUTH_KEY'		=>  'administrator',
    //'USER_AUTH_UID'             =>  'id', //设置保存用户的session 数据库ID
    'USER_AUTH_MODEL'           =>  'Admin',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '/Login-index',// 默认认证网关
    'NOT_AUTH_MODULE'           =>  'Login',	// 默认无需认证模块
    'REQUIRE_AUTH_MODULE'       =>  '',		// 默认需要认证模块
    'NOT_AUTH_ACTION'           =>  '',		// 默认无需认证操作
    'REQUIRE_AUTH_ACTION'       =>  '',		// 默认需要认证操作
    'GUEST_AUTH_ON'             =>  false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'             =>  0,        // 游客的用户ID
    'RBAC_ROLE_TABLE'           =>  'rs_role',
    'RBAC_USER_TABLE'           =>  'rs_role_user',
    'RBAC_ACCESS_TABLE'         =>  'rs_access',
    'RBAC_NODE_TABLE'           =>  'rs_node',
);