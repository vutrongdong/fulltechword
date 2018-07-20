<?php

namespace FTW\Services;

use Laravel\Socialite\Contracts\User as ProviderUser;
use FTW\Repositories\LinkedSocialAccounts\LinkedSocialAccountRepository;
use FTW\Repositories\Users\UserRepository;

class LinkedSocialAccountService
{
    /**
     * Account Repository
     * @var Repository
     */
    public $account;

    /**
     * User Repository
     * @var Repository
     */
    public $user;

    /**
     * Linked Social Account Service Constructor.
     * @param LinkedSocialAccountRepository $socialAccount
     */
    public function __construct(UserRepository $user, LinkedSocialAccountRepository $socialAccount)
    {
        $this->account = $socialAccount;
        $this->user = $user;
    }

    /**
     * Find an user by provider id or create new.
     * @param  ProviderUser $user
     * @param  string       $provider
     * @return Model
     */
    public function findOrCreate(ProviderUser $user, $provider)
    {
        if ($account = $this->account->getByProvider($provider, $user->getId())) {
            return $account;
        }

        $email = $user->getEmail() ?? $user->getNickname();
        $_user = $this->user->getByEmail($email);

        // Không tìm thấy user thì tạo mới và link với tài khoản social.
        if (!$_user) {
            $_user = $this->user->store([
                'email' => $email,
                'name' => $user->getName()
            ]);
        }

        $account = $this->account->store([
            'provider_id' => $user->getId(),
            'provider_name' => $provider,
            'user_id' => $_user->id
        ]);

        // Link it
        $account->user()->associate($_user);
        $account->save();

        return $_user;
    }
}
