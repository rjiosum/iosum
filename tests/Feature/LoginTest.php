<?php

namespace Iosum\AdminAuth\Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Iosum\AdminAuth\Tests\TestCase;


class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function canLoginAdminWithValidCredentials(): void
    {
        $user = $this->create('Iosum\AdminAuth\Models\Admin', ['email'=>'raj@demo.com']);

        $this->postJson(route('admin.login'), [
            'email' => $user->email, 'password' => 'password'
        ])
            ->assertJson([
                "status" => true,
                "data" => [
                    "name" => $user->first_name . ' ' . $user->last_name,
                    "email" => $user->email
                ],
                "message" => trans('admin-auth::auth.login')
            ])
            ->assertJsonStructure([
                'status',
                'data' => ['id', 'uuid', 'first_name', 'last_name', 'name', 'email', 'avatar']
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
            'password' => 'wrong'
        ])
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => [trans('auth.failed')]
                ]
            ])
            ->assertJsonStructure([
                'message',
                'errors'
            ])
            ->assertStatus(422);
    }
}
