<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Iosum\AdminAuth\Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canLoginAdminWithValidCredentials(): void
    {
        $this->withoutExceptionHandling();
        $user = $this->create('Iosum\AdminAuth\Models\Admin', ['email' => 'raj@demo.com']);

        $this->postJson(route('admin.login'), [
            'email' => $user->email, 'password' => 'password',
        ])
            ->assertJson([
                "status" => true,
                "data" => [
                    "data" => [
                        "type" => "admin",
                        "admin_id" => $user->uuid,
                        "attributes" => [
                            "first_name" => $user->first_name,
                            "last_name" => $user->last_name,
                            "name" => $user->first_name . " " . $user->last_name,
                            "email" => $user->email
                        ]
                    ],
                    "links" => [
                        "self" => route('admin.profile'),
                    ],
                ],
                "message" => trans('admin-auth::auth.login'),
            ])
            ->assertJsonStructure([
                "status",
                "data" => [
                    "data" => [
                        "type",
                        "admin_id",
                        "attributes" => [
                            "first_name",
                            "last_name",
                            "name",
                            "email"
                        ]
                    ],
                    "links" => [
                        "self"
                    ],
                ],
                "message"
            ])
            ->assertCookie(config('passport.admin.cookie.name'))
            ->assertStatus(200);
    }

    /** @test */
    public function willNotLoginAdminWithInvalidCredentials(): void
    {
        $user = $this->create('Iosum\AdminAuth\Models\Admin');

        $this->postJson(route('admin.login'), [
            'email' => $user->email,
            'password' => 'wrong',
        ])
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => [trans('auth.failed')],
                ],
            ])
            ->assertJsonStructure([
                'message',
                'errors',
            ])
            ->assertStatus(422);
    }
}
