<?php
namespace FTW\Http\Controllers\Frontend\V1;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;

class FrontendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewPath = 'v1';

    public function __construct()
    {
        View::share('blogLastest', \App::make(\FTW\Repositories\Blogs\BlogRepository::class)->getForLastest());
        View::share('parentCategories', \App::make(\FTW\Repositories\Categories\CategoryRepository::class)->getFisrtLevel());
        View::share('categories', \App::make(\FTW\Repositories\Categories\CategoryRepository::class)->getToTree());
    }

    /**
     * render view
     * @author KingDarkness <nguyentranhoan13@gmail.com>
     * @date   2018-07-06
     * @param  [string]     $template [description]
     * @return [View]               [description]
     */
    protected function render($template = null)
    {
        return view($this->viewPath . '.' . $template);
    }
}
