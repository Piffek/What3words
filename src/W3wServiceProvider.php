<?php

namespace Wrapper\What3words;

use Illuminate\Support\ServiceProvider;

class W3wServiceProvider extends ServiceProvider{
	
	protected function dir(){
		
		return __DIR__;
	}
	
	
	public function boot(){
	
		$this->app['router']->group(['namespace' => 'Wrapper\What3words\Controllers'], function(){
			$this->loadRoutesFrom($this->dir().'/routes/web.php');
			$this->loadViewsFrom($this->dir() . '/views', 'views');
		});
		
	}
	
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
	}
	
	
}