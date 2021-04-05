<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Iosum\AdminNav\Tests\TestCase;

class AdminNavigationStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canStoreAdminNavigation(): void
    {
        $this->postJson(route('admin.nav.store'), $data = $this->data())
            ->assertStatus(Response::HTTP_ACCEPTED)
            ->assertJsonStructure([
                "status",
                "data" => [
                    "type",
                    "id",
                    "attributes" => [
                        "parent_id",
                        "position",
                        "title",
                        "icon",
                        "route_name",
                        "route_path",
                        "created_at",
                        "updated_at",
                        "created_h",
                        "updated_h"
                    ]
                ],
                "message",
            ])
            ->assertJson([
                "status" => true,
                "data" => [
                    "type" => "admin-nav",
                    "attributes" => [
                        "title" => $data['title'],
                        "route_name" => $data['route_name'],
                        "route_path" => $data['route_path'],
                    ]
                ],
                "message" => trans('base::response.success.create', ['attribute' => 'Navigation']),
            ]);

        $this->assertDatabaseHas('admin_navigations', [
            "title" => $data["title"],
            "route_name" => $data['route_name'],
            "route_path" => $data['route_path'],
        ]);
    }

    /** @test */
    public function willThrowValidationErrorWhileCreatingAdminNavigationWithWrongInput(): void
    {
        //title field is required
        $this->postJson(route('admin.nav.store'), $this->data(['title' => '']))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'title' => [
                        trans('validation.required', ['attribute' => 'title']),
                    ],
                ],
            ]);

        //title can have max 50 character
        $this->postJson(route('admin.nav.store'), $this->data(['title' => Str::random(70)]))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'title' => [
                        trans('validation.max.string', ['attribute' => 'title', 'max' => 50]),
                    ],
                ],
            ]);

        //route name field is required
        $this->postJson(route('admin.nav.store'), $this->data(['route_name' => '']))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'route_name' => [
                        trans('validation.required', ['attribute' => 'route name']),
                    ],
                ],
            ]);

        //route path field is required
        $this->postJson(route('admin.nav.store'), $this->data(['route_path' => '']))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'route_path' => [
                        trans('validation.required', ['attribute' => 'route path']),
                    ],
                ],
            ]);
    }
}
