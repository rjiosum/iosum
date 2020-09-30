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
                        "route",
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
                        "route" => $data['route'],
                    ]
                ],
                "message" => trans('base::response.success.create', ['attribute' => 'Navigation']),
            ]);

        $this->assertDatabaseHas('admin_navigations', [
            "title" => $data["title"],
            "route" => $data['route'],
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

        //route field is required
        $this->postJson(route('admin.nav.store'), $this->data(['route' => '']))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'route' => [
                        trans('validation.required', ['attribute' => 'route']),
                    ],
                ],
            ]);
    }
}
