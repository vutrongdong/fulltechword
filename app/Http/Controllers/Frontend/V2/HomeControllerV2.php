<?php

namespace FTW\Http\Controllers\Frontend\V2;
use FTW\Repositories\Blogs\BlogRepository;
use FTW\Repositories\Blogs\CategoryRepository;
use Illuminate\Http\Request;

class HomeControllerV2 extends FrontendController {

	protected $data;

	public function __construct(BlogRepository $blog) {
		$this->data = $blog;
	}

	public function index() {
		$menu = \App::make(\FTW\Repositories\Categories\CategoryRepository::class)->getFisrtLevel();
		$value = $this->data->getForHome();
		$news = $this->data->getForLastest();
		$hots = $this->data->getByHot();
		return view('v2.home', compact('value', 'menu', 'news', 'hots'));
	}
	public function details($id) {
		$detail = $this->data->getById($id);
		$story = $this->data->getforStories();
		return view('v2.detail', compact('detail', 'story'));
	}
	public function Category($id) {
		$value = $this->data->getByCategory($id);
		return view('v2.category', compact('value'));
	}

	public function Search(Request $request) {
		$keyword = $request->keyword;
		$Sblogs = $this->data->getSearch($keyword);
		return view('v2.search', compact('keyword', 'Sblogs'));
	}
}
