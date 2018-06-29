<?php

return [

    // 默认发送的机器人

    'default' => [
        // 是否要开启机器人，关闭则不再发送消息
        'enabled' => env('DING_ENABLED',false),
        // 机器人的access_token
        'token' => env('DING_TOKEN','5704f85e8ba225722b6239b8b8a3ac78e37e18680f3e85650765d1947aa3f529'),
        // 钉钉请求的超时时间
        'timeout' => env('DING_TIME_OUT',2.0)
    ],

    'other' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN',''),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ]

];