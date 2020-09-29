<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Iosum\AdminAuth\Tests\TestCase;
use Laravel\Passport\Passport;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canGetLoggedInAdminDetails(): void
    {
        //$this->withoutExceptionHandling();

        $user = $this->create('Iosum\AdminAuth\Models\Admin');
        Passport::actingAs($user, [], 'api:admin');

        $this->getJson(route('admin.profile'))
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
                "message" => "",
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
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function willNotGetAdminDetailsIfAdminIsNotLoggedIn(): void
    {
        //$this->withoutExceptionHandling();

        $this->getJson(route('admin.profile'))
            ->assertJson([
                "status" => false,
                "data" => [],
                "message" => "",
            ])
            ->assertJsonStructure([
                "status",
                "data",
                "message"
            ])
            ->assertStatus(Response::HTTP_PRECONDITION_FAILED);
    }
}
