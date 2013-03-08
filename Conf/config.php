<?php
return array(
    //'配置项'=>'配置值'
    'URL_MODEL'                 =>  3, // 如果你的环境不支持PATHINFO 请设置为3
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  'localhost',
    'DB_NAME'                   =>  'reshop',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  '',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  're_',
//    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
//    'DB_DSN'                    =>  'mysql://root@localhost:3306/reshop',
    'DEFAULT_FILTER'            =>  'strip_tags,htmlspecialchars',
    'APP_GROUP_LIST'            =>  'Supply,Order',
    'DEFAULT_GROUP'             =>  'Supply',
    'APP_GROUP_MODE'            =>  1,
    'SHOW_PAGE_TRACE'           =>  1//显示调试信息
);
?>