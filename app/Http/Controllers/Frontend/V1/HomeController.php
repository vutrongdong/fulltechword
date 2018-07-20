<?php

namespace FTW\Http\Controllers\Frontend\V1;

use Illuminate\Http\Request;
use FTW\Repositories\Blogs\BlogRepository;

class HomeController extends FrontendController
{
    public function __construct(BlogRepository $blog)
    {
        $this->blog = $blog;
        parent::__construct();
    }

    public function index(Request $request)
    {
        return $this->render('home')->with([
            'blogs' => $this->blog->getForHome()
        ]);
    }

    public function detail(Request $request, $slug)
    {
        if ($blog = $this->blog->getBySlug($slug)) {
            return $this->render('detail')->with([
                'blog' => $blog
            ]);
        } else {
            abort(404);
        }
    }

    public function category(Request $request, $slug)
    {
        if ($category = \App::make(\FTW\Repositories\Categories\CategoryRepository::class)->getBySlug($slug)) {
            return $this->render('category')->with([
                'blogs' => $this->blog->getByCategory($category->id),
                'category' => $category
            ]);
        } else {
            abort(404);
        }
    }
}
