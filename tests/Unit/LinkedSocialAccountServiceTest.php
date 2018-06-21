<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\User as ProviderUser;
use \Mockery;

use App\User;
use App\Repositories\LinkedSocialAccounts\LinkedSocialAccount;
use App\Services\LinkedSocialAccountService;

class LinkedSocialAccountServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_can_get_user_with_social_account()
    {
        $provider = 'facebook';
        $providerId = 'facebook123';

        $user = factory(User::class)->create();
        $account = factory(LinkedSocialAccount::class)->create([
            'user_id' => $user->id,
            'provider_id' => $providerId,
            'provider_name' => $provider
        ]);

        $providerUser = Mockery::mock(ProviderUser::class);
        $providerUser->shouldReceive('getId')->once()->andReturn($providerId);

        $accountService = \App::make(LinkedSocialAccountService::class);
        $_user = $accountService->findOrCreate($providerUser, $provider);

        $this->assertInstanceOf(User::class, $_user);
        $this->assertEquals($_user->id, $user->id);
        $this->assertEquals($_user->name, $user->name);
        $this->assertEquals($_user->email, $user->email);
    }

    /** @test */
    public function it_can_create_social_account_and_get_user()
    {
        $provider = 'facebook';
        $providerId = 'facebook123';

        $user = factory(User::class)->create();

        $providerUser = Mockery::mock(ProviderUser::class);
        $providerUser->shouldReceive('getId')->times(2)->andReturn($providerId);
        $providerUser->shouldReceive('getEmail')->once()->andReturn($user->email);

        $accountService = \App::make(LinkedSocialAccountService::class);
        $_user = $accountService->findOrCreate($providerUser, $provider);

        $this->assertInstanceOf(User::class, $_user);
        $this->assertEquals($_user->id, $user->id);
        $this->assertEquals($_user->name, $user->name);
        $this->assertEquals($_user->email, $user->email);

        $account = LinkedSocialAccount::where('user_id', $user->id)->first();
        $this->assertEquals($account->provider_id, $providerId);
    }

    /** @test */
    public function it_can_create_user_and_social_account()
    {
        $name = 'Alvin Tran';
        $email = 'neverback88@gmail.com';
        $provider = 'facebook';
        $providerId = 'facebook123';

        $providerUser = Mockery::mock(ProviderUser::class);
        $providerUser->shouldReceive('getId')->times(2)->andReturn($providerId);
        $providerUser->shouldReceive('getEmail')->once()->andReturn($email);
        $providerUser->shouldReceive('getName')->once()->andReturn($name);

        $accountService = \App::make(LinkedSocialAccountService::class);
        $_user = $accountService->findOrCreate($providerUser, $provider);

        $this->assertInstanceOf(User::class, $_user);
        $this->assertEquals($_user->name, $name);
        $this->assertEquals($_user->email, $email);

        $account = LinkedSocialAccount::where('user_id', $_user->id)->first();
        $this->assertEquals($account->provider_id, $providerId);
    }

    /**
     * tearDown.
     * @return void
     */
    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }
}
