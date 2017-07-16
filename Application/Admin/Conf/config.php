<?php
return array(

	// 添加数据库配置信息
	'DB_TYPE'=>'mysqli',// 数据库类型
	'DB_HOST'=>'localhost',// 服务器地址
	'DB_NAME'=>'integration',// 数据库名
	'DB_USER'=>'root',// 用户名
	'DB_PWD'=>'dyk0905',// 密码
	'DB_PORT'=>3306,// 端口
	'DB_PREFIX'=>'tp_',// 数据库表前缀
	'DB_CHARSET'=>'utf8',// 数据库字符集

    //'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__STATIC__'=>__ROOT__ . '/Public/static',
        '__JS__'=>__ROOT__ . '/Public/Admin/js',
        '__CSS__'=>__ROOT__ . '/Public/Admin/css',
        '__IMG__'=>__ROOT__.'/Public/Admin/js',
        '__BRACKET__'=>__ROOT__.'/Public/Admin/bracket'
    ),
       
);