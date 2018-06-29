<?php
return [
    'title' => "APi接口文档",  //文档title
    'version'=>'1.0.0', //文档版本
    'copyright'=>'Powered By Zhangweiwei', //版权信息
    'controller' => [
        //需要生成文档的类
        'App\\Http\\Controllers\\Api\\LoginController',
        'App\\Http\\Controllers\\Api\\AccountController',
    ],
    'filter_method' => [
        //过滤 不解析的方法名称
        '_empty'
    ],
    'return_format' => [
        //数据格式
        'status' => "200(成功返回信息)/300(验证错误或返回失败信息)/(登录码1001没输入token和id,1002没有找到用户,1003登录态失效)",
        'message' => "提示信息",
        'data' => '[]', //默认返回值,当不存在参数时 返回的值，填字符串
    ],
    'public_header' => [
        //全局公共头部参数
        //如：['name'=>'version', 'require'=>1, 'default'=>'', 'desc'=>'版本号(全局)']
    ],
    'public_param' => [
        //全局公共请求参数，设置了所以的接口会自动增加次参数
        //如：['name'=>'token', 'type'=>'string', 'require'=>1, 'default'=>'', 'other'=>'' ,'desc'=>'验证（全局）')']
    ],
];