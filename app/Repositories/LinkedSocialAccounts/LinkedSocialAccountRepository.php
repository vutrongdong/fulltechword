<?php

namespace FTW\Repositories\LinkedSocialAccounts;

use FTW\Repositories\LinkedSocialAccounts\LinkedSocialAccount;
use FTW\Repositories\BaseRepository;

class LinkedSocialAccountRepository extends BaseRepository
{
	/**
	 * LinkedSocialAccount model
	 * @var Model
	 */
	protected $model;

	/**
	 * LinkedSocialAccountRepository constructor.
	 *
	 * @param LinkedSocialAccount $socialAccount
	 */
	public function __construct(LinkedSocialAccount $socialAccount)
	{
		$this->model = $socialAccount;
	}

	/**
	 * Get user by authentication provider.
	 *
	 * @param  string $provider_name
	 * @param  string $provider_id
	 * @return User|null
	 */
	public function getByProvider($provider_name, $provider_id)
	{
		$account = $this->model->where('provider_name', $provider_name)
						->where('provider_id', $provider_id)
						->first();

		if ($account) {
			return $account->user;
		} else {
			return null;
		}
	}
}
