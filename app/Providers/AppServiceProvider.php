<?php

namespace FTW\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		View::share('menu', \App::make(\FTW\Repositories\Categories\CategoryRepository::class)->getFisrtLevel());
		View::share('blogLastest', \App::make(\FTW\Repositories\Blogs\BlogRepository::class)->getForLastest());
		View::share('hots', \App::make(\FTW\Repositories\Blogs\BlogRepository::class)->getByHot());
		View::share('news', \App::make(\FTW\Repositories\Blogs\BlogRepository::class)->getForLastest());
		View::share('categories', \App::make(\FTW\Repositories\Categories\CategoryRepository::class)->getToTree());
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
