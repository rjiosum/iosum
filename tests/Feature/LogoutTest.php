<?php

namespace Iosum\AdminAuth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Iosum\AdminAuth\Tests\TestCase;
use Laravel\Passport\Passport;


class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canLogoutAdmin(): void
    {
        $this->withoutExceptionHandling();

        $user = $this->create('Iosum\AdminAuth\Models\Admin');

        Passport::actingAs($user, [], 'api:admin');

        $this->postJson(route('admin.logout'))
            ->assertJson([
                "status" => true,
                'message' => trans('admin-auth::auth.logout')
            ])
            ->assertJsonStructure([
                'status',
                'message'
            ])
            ->assertCookieExpired(config('passport.admin.cookie.name'))
            ->assertStatus(200);
    }
}
