<?php
namespace FTW\Http\Controllers\Frontend\V2;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class FrontendController extends BaseController {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $viewPath = 'v2';

	public function __construct() {
		View::share('blogLastest', \App::make(\FTW\Repositories\Blogs\BlogRepository::class)->getForLastest());
		View::share('categories', \App::make(\FTW\Repositories\Categories\CategoryRepository::class)->getToTree());
	}

	protected function render($template = null) {
		return view($this->viewPath . '.' . $template);
	}
}
