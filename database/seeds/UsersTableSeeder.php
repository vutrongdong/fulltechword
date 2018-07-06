<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin
        $admin = factory(App\User::class)->create([
            'name' => 'SuperAdmin',
            'email' => 'admin@fulltechword.com',
            'password' => 'admin'
        ]);

        $adminRole = factory(App\Repositories\Roles\Role::class)->create([
            'name' => 'Super admin',
            'slug' => 'superadmin',
            'permissions' => [
                'admin.super-admin' => true
            ]
        ]);

        \DB::statement("INSERT INTO `role_users` (`user_id`, `role_id`) VALUES
            ({$admin->id}, {$adminRole->id})
        ");

        // Admin
        factory(App\Repositories\Roles\Role::class)->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => [
                'admin.manage-user' => true,
                'admin.access' => true,
                'admin.report' => true,
                'setting.update' => true,
                'role.view' => true,
                'role.create' => true,
                'role.update' => true,
                'role.delete' => true,
            ]
        ]);

        // Staff
        factory(App\Repositories\Roles\Role::class)->create([
            'name' => 'Moderator',
            'slug' => 'moderator',
            'permissions' => [
                'admin.access' => true,
                'setting.update' => true,
                'role.view' => true,
            ]
        ]);
    }
}
