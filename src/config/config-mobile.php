<?php
return [

    // 合作身份者id，以2088开头的16位纯数字
    'partner' => '',

    //收款支付宝账号，跟partner一样的值
    'seller_id'	=> '',

    // 商户的私钥（后缀是.pen）文件相对路径
    'private_key_path' => config_path('robote-alipay/rsa_private_key.pem'),

    // 支付宝公钥（后缀是.pen）文件相对路径
    'ali_public_key_path' => config_path('robote-alipay/alipay_public_key.pem'),

    // 签名方式 不需修改
    'sign_type' => strtoupper('RSA'),

    // 字符编码格式 目前支持 gbk 或 utf-8
    'input_charset' => strtolower('utf-8'),

    // ca证书路径地址，用于curl中ssl校验
    'cacert' => '..pem/cacert.pem',

    // 访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    'transport' => 'http'
];
