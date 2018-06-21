<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\Roles\Role;

class RoleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_can_access_with_permission()
    {
        $role = factory(Role::class)->create([
            "permissions" => [
                "posts.create" => true,
                "posts.read" => true,
                "posts.update" => true,
                "posts.delete" => false,
            ]
        ]);

        $this->assertTrue($role->hasAccess(['posts.create']));
        $this->assertTrue($role->hasAccess(['posts.read']));
        $this->assertTrue($role->hasAccess(['posts.update']));
        $this->assertFalse($role->hasAccess(['posts.delete']));

        $this->assertTrue($role->hasAccess(['posts.create', 'posts.read']));
        $this->assertTrue($role->hasAccess(['posts.create', 'posts.read', 'posts.delete']));
    }
}
