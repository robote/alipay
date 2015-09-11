<?php
namespace Robote\Alipay;

use Illuminate\Support\ServiceProvider;

class AlipayServiceProvider extends ServiceProvider
{

	/**
	 * boot process
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../config/config-mobile.php' => config_path('robote-alipay-mobile.php'),
			__DIR__ . '/../../config/config-wap.php' => config_path('robote-alipay-wap.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../../config/config-mobile.php', 'robote-alipay-mobile');
		$this->mergeConfigFrom(__DIR__ . '/../../config/config-wap.php', 'robote-alipay-wap');

		$this->app->bind('alipay.mobile', function ($app)
		{
            $alipay = new AlipayMobile();
			return $alipay;
		});

		$this->app->bind('alipay.wap', function ($app)
		{
            $alipay = new AlipayWap($app);

			return $alipay;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'alipay.mobile',
			'alipay.wap'
		];
	}
}
