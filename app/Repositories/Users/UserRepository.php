<?php

namespace FTW\Repositories\Users;

use FTW\Repositories\BaseRepository;
use FTW\User;

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
