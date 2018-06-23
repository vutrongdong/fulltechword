<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Repositories\Users\UserRepository;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_can_get_all_users()
    {
        $users = factory(User::class, 3)->create();

        $userRepository = \App::make(UserRepository::class);
        $_users = $userRepository->getAll();

        $this->assertInstanceOf(Collection::class, $_users);
        $this->assertEquals($_users->count(), 3);
    }

    /** @test */
    public function it_can_filter_user_with_empty_params()
    {
        $users = factory(User::class, 3)->create();

        $userRepository = \App::make(UserRepository::class);
        $_users = $userRepository->getByQuery();

        $this->assertInstanceOf(Paginator::class, $_users);
        $this->assertEquals($_users->count(), 3);
    }

    /** @test */
    public function it_can_filter_user_with_sorting()
    {
        $users = factory(User::class, 3)->create();

        $userRepository = \App::make(UserRepository::class);
        $_users = $userRepository->getByQuery([
            'sort' => 'id:-1'
        ]);

        $this->assertInstanceOf(Paginator::class, $_users);
        $this->assertEquals($_users->count(), 3);
        $this->assertEquals($_users[0]->id, 3);
        $this->assertEquals($_users[1]->id, 2);
        $this->assertEquals($_users[2]->id, 1);
    }

    /** @test */
    public function it_can_show_an_user()
    {
        $user = factory(User::class)->create();

        $userRepository = \App::make(UserRepository::class);
        $_user = $userRepository->getById($user->id);

        $this->assertInstanceOf(User::class, $_user);
        $this->assertEquals($_user->name, $user->name);
        $this->assertEquals($_user->email, $user->email);
    }

    /** @test */
    public function it_can_show_null_if_not_exist_user()
    {
        $userRepository = \App::make(UserRepository::class);
        $_user = $userRepository->getById(99999);

        $this->assertEquals(null, $_user);
    }

    /** @test */
    public function it_can_show_an_user_in_trash()
    {
        $user = factory(User::class)->create();
        $user->delete();

        $userRepository = \App::make(UserRepository::class);
        $_user = $userRepository->getById($user->id, true);

        $this->assertInstanceOf(User::class, $_user);
        $this->assertEquals($_user->name, $user->name);
        $this->assertEquals($_user->email, $user->email);
        $this->assertNotNull($_user->deleted_at);
    }

    /** @test */
    public function it_can_show_multi_user()
    {
        $users = factory(User::class, 3)->create();
        $userId = array_pluck($users, 'id');

        $userRepository = \App::make(UserRepository::class);
        $_users = $userRepository->getById($userId);

        $this->assertInstanceOf(Collection::class, $_users);
        $this->assertEquals(count($_users), 3);
    }

    /** @test */
    public function it_can_create_an_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 123
        ];

        $userRepository = \App::make(UserRepository::class);
        $user = $userRepository->store($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->name, $data['name']);
        $this->assertEquals($user->email, $data['email']);
        $this->assertTrue(\Hash::check($data['password'], $user->password));
    }

    /** @test */
    public function it_can_insert_a_batch_of_user()
    {
        $data = [
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => bcrypt('123')
            ],
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => bcrypt('321')
            ]
        ];

        $userRepository = \App::make(UserRepository::class);
        $result = $userRepository->store($data, true);

        $this->assertEquals($result, true);
    }

    /** @test */
    public function it_can_update_an_user()
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];

        $userRepository = \App::make(UserRepository::class);
        $result = $userRepository->update($user->id, $data);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($result->name, $data['name']);
        $this->assertEquals($result->email, $data['email']);
    }

        /** @test */
    public function it_can_not_update_an_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];

        $userRepository = \App::make(UserRepository::class);
        $result = $userRepository->update(999, $data);

        $this->assertTrue($result === null);
    }

    /** @test */
    public function it_can_delete_an_user()
    {
        $user = factory(User::class)->create();
        $userRepository = \App::make(UserRepository::class);

        $result = $userRepository->delete($user->id);
        $this->assertTrue($result);
    }

    /** @test */
    public function it_can_restore_a_deleted_user()
    {
        $user = factory(User::class)->create();
        $user->delete();

        $userRepository = \App::make(UserRepository::class);
        $result = $userRepository->restore($user->id);
        $this->assertTrue($result);
    }

    /** @test */
    public function it_can_get_an_user_by_email()
    {
        $user = factory(User::class)->create();
        $userRepository = \App::make(UserRepository::class);

        $result = $userRepository->getByEmail($user->email);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($result->name, $user->name);
        $this->assertEquals($result->email, $user->email);
    }

    /** @test */
    public function it_can_access_with_permissions()
    {
        $user = factory(User::class)->create();
        $role = factory(\App\Repositories\Roles\Role::class)->create([
            "permissions" => [
                "posts.create" => true,
                "posts.read" => true,
                "posts.update" => true,
                "posts.delete" => false,
            ]
        ]);
        $user->roles()->attach($role->id);

        $this->assertTrue($user->hasAccess(['posts.create']));
        $this->assertTrue($user->hasAccess(['posts.read']));
        $this->assertTrue($user->hasAccess(['posts.update']));
        $this->assertFalse($user->hasAccess(['posts.delete']));

        $this->assertTrue($user->hasAccess(['posts.create', 'posts.read']));
        $this->assertTrue($user->hasAccess(['posts.create', 'posts.read', 'posts.delete']));
    }

    /** @test */
    public function it_can_in_role()
    {
        $user = factory(User::class)->create();
        $role = factory(\App\Repositories\Roles\Role::class)->create();
        $user->roles()->attach($role->id);

        $isRole = $user->inRole($role->slug);

        $this->assertTrue($isRole);
    }

    /** @test */
    public function it_can_be_superadmin()
    {
        $user = factory(User::class)->create();
        $role = factory(\App\Repositories\Roles\Role::class)->create([
            'permissions' => [
                'admin.super-admin' => true
            ]
        ]);

        $user->roles()->attach($role->id);

        $this->assertTrue($user->isSuperAdmin());
    }
}
