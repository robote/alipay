Alipay
======

Alipay 移动支付 for Laravel5

## 安装

```
composer require "robote/alipay": "dev-master"
```

更新你的依赖包 ```composer update``` 或者全新安装 ```composer install```。


## 使用


`config/app.php` 添加 providers

```php
    'providers' => [
        // ...
        'Robote\Alipay\AlipayServiceProvider',
    ]
```

运行 `php artisan vendor:publish` 命令，发布配置文件到你的项目中。

配置文件  `config/robote-alipay-wap.php` 为移动版支付宝配置， `config/robote-alipay-mobile.php` 为手机端支付宝配置。

在`config` 文件夹中新增 `robote-alipay` 文件夹，在该文件夹下放入  rsa_private_key.pem ,alipay_public_key.pem 两个文件

## 例子

### 支付申请

#### 手机网页

```php
	// 创建支付单。
	$alipay = app('alipay.web');

	// 跳转到支付页面。其中 $show_url,$subject,$body 三个参数可为空
    return $alipay->payment($order_id,$amount,$show_url,$subject,$body);
```


### 结果通知

#### 网页

```php
	/**
	 * 异步通知
	 */
	public function webNotify()
	{
		// 验证请求。
		if (! app('alipay.web')->verify()) {
			Log::notice('Alipay notify post data verification fail.', [
				'data' => Request::instance()->getContent()
			]);
			return 'fail';
		}

		// 判断通知类型。
		switch (Input::get('trade_status')) {
			case 'TRADE_SUCCESS':
			case 'TRADE_FINISHED':
				// TODO: 支付成功，取得订单号进行其它相关操作。

				break;
		}
	
		return 'success';
	}

	/**
	 * 同步通知
	 */
	public function webReturn()
	{
		// 验证请求。
		if (! app('alipay.web')->verify()) {
			Log::notice('Alipay return query data verification fail.', [
				'data' => Request::getQueryString()
			]);
			return view('alipay.fail');
		}

		// 判断通知类型。
		switch (Input::get('trade_status')) {
			case 'TRADE_SUCCESS':
			case 'TRADE_FINISHED':
				// TODO: 支付成功，取得订单号进行其它相关操作。

				break;
		}

		return view('alipay.success');
	}
```
