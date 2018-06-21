<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Repositories\LinkedSocialAccounts\LinkedSocialAccount;
use App\Repositories\LinkedSocialAccounts\LinkedSocialAccountRepository;

class LinkedSocialAccountTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_can_not_get_user_who_havent_social_account()
    {
        $user = factory(User::class)->create();

        $accountRepository = \App::make(LinkedSocialAccountRepository::class);
        $_user = $accountRepository->getByProvider('facebook', 'facebook123');

        $this->assertTrue($_user === null);
    }

    /** @test */
    public function it_can_get_user_by_provider()
    {
        $user = factory(User::class)->create();
        $account = factory(LinkedSocialAccount::class)->create([
            'user_id' => $user->id,
            'provider_id' => 'facebook123',
            'provider_name' => 'facebook'
        ]);

        $accountRepository = \App::make(LinkedSocialAccountRepository::class);
        $_user = $accountRepository->getByProvider('facebook', 'facebook123');

        $this->assertInstanceOf(User::class, $_user);
        $this->assertEquals($_user->user_id, $user->user_id);
        $this->assertEquals($_user->name, $user->name);
        $this->assertEquals($_user->email, $user->email);
    }
}
