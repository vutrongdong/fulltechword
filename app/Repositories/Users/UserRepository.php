<?php

namespace App\Repositories\Users;

use App\Repositories\BaseRepository;
use App\User;

class UserRepository extends BaseRepository
{
	/**
	 * User model.
	 * @var Model
	 */
	protected $model;

	/**
	 * UserRepository constructor.
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->model = $user;
	}
	/**
	 * Get user by email
	 * @param  string $email
	 * @return Model
	 */
	public function getByEmail($email)
	{
		return $this->model->whereEmail($email)->first();
	}
}
