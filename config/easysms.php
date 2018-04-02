<?php
return [
	//http请求超时时间（秒）
	'timeout' => 5.0,

	//默认发送配置
	'default' => [
		//网关调用策略，默认为顺序调用
		'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

		//默认可用的发送网关
		'gateways' => [
			'yunpian',
		],
	],

	//可用的网关配置
	'gateways' => [
		'errorlog' => [
			'file' => '/var/log/easy-sms.log',
		],
		'yunpian' =>[
			'api_key' => env('YUNPIAN_API_KEY'),
		],
	],
];