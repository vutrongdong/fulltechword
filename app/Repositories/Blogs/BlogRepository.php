<?php

namespace FTW\Repositories\Blogs;

use FTW\Repositories\BaseRepository;
use FTW\Repositories\UploadTrait;

class BlogRepository extends BaseRepository {
	use UploadTrait;
	/**
	 * Blog model.
	 * @var Model
	 */
	protected $model;

	/**
	 * BlogRepository constructor.
	 * @param Blog $blog
	 */
	public function __construct(Blog $blog) {
		$this->model = $blog;
	}

	/**
	 * Store a record
	 *
	 * @param  array  $data
	 * @param  boolean $isBatch
	 * @return Model|bool
	 */
	public function store(array $data, $isBatch = false) {
		$tags = array_get($data, 'tags', []);
		$model = $this->model->create($data);
		if ($tags && count($tags)) {
			$model->tags()->sync(array_pluck($tags, 'id'));
		}
		return $model;
	}

	/**
	 * Update a record
	 *
	 * @param  int $id
	 * @param  array $data
	 * @return Model|null
	 */
	public function update($id, array $data) {
		if ($record = $this->getById($id)) {
			$tags = array_get($data, 'tags', []);
			$record->fill($data)->save();
			$record->tags()->sync(array_pluck($tags, 'id'));
			return $record;
		}
		return null;
	}

	/**
	 * Delete or destroy record
	 *
	 * @param  array|int $id
	 * @return bool|null
	 */
	public function delete($id, $isDestroy = false) {
		if ($record = $this->getById($id)) {
			$record->tags()->sync([]);
			return $isDestroy ? $record->forceDelete()
			: $record->delete();
		}
		return null;
	}

	public function getForHome() {
		return $this->model
			->where('active', Blog::ENABLE)
			->orderBy('created_at', 'DESC')
			->orderBy('updated_at', 'DESC')
			->simplePaginate(20);
	}

	public function getForLastest() {
		return $this->model
			->where('active', Blog::ENABLE)
			->orderBy('created_at', 'DESC')
			->orderBy('updated_at', 'DESC')
			->limit(10)
			->get();
	}

	public function getBySlug($slug) {
		return $this->model
			->where('active', Blog::ENABLE)
			->where('slug', $slug)
			->first();
	}

	public function getByCategory($cid) {
		return $this->model
			->where('active', Blog::ENABLE)
			->where('category_id', $cid)
			->simplePaginate(20);
	}

	public function getByHot() {
		return $this->model
			->where('hot', 1)
			->limit(8)
			->get();
	}

	public function getId($id) {
		return $this->model->where('id', $id)->get();
	}

	public function getforStories() {
		return $this->model
			->orderBy('id', 'desc')
			->limit(8)
			->get();
	}

	public function getSearch($keyword) {
		return $this->model->where('title', 'like', '%$keyword%')
			->orWhere('slug', 'like', '%' . $keyword . '%')
			->orWhere('teaser', 'like', '%' . $keyword . '%')
			->orWhere('content', 'like', '%' . $keyword . '%')
			->orderBy('id', 'desc')
			->orderBy('updated_at')
			->get();
	}
}
