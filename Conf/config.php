<?php
return array(
    //'配置项'=>'配置值'
    'URL_MODEL'                 =>  3, // 如果你的环境不支持PATHINFO 请设置为3
    'URL_PATHINFO_DEPR'         =>  '-', // PATHINFO模式下，各参数之间的分割符号
//    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
//    'DB_DSN'                    =>  'mysql://root@localhost:3306/reshop',
    'DEFAULT_FILTER'            =>  'strip_tags,htmlspecialchars',
    'APP_GROUP_LIST'            =>  'Supply,Order',
    'DEFAULT_GROUP'             =>  'Supply',
    'APP_GROUP_MODE'            =>  1,
    'SHOW_PAGE_TRACE'           =>  true,//显示调试信息

    'APP_FILE_CASE' => true,   // 是否检查文件的大小写 对Windows平台有效
    
    'TOKEN_ON'=>true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'=>TRUE,  //令牌验证出错后是否重置令牌 默认为true
    'DEFAULT_CHARSET'       => 'utf-8',
);
?>