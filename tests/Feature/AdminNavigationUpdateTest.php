<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Iosum\AdminNav\Tests\TestCase;

class AdminNavigationUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canUpdateAdminNavigation(): void
    {
        $nav = $this->create('Iosum\AdminNav\Models\AdminNavigation');

        $this->patchJson(
            route('admin.nav.update', ['nav' => $nav]),
            $data = $this->data(['title' => 'This is a new title'])
        )
            ->assertJson([
                "status" => true,
                "data" => [
                    "attributes" => [
                        "title" => $data['title'],
                    ]
                ],
                "message" => trans('base::response.success.update', ['attribute' => 'Navigation']),
            ])
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
            ->assertStatus(Response::HTTP_ACCEPTED);

        $this->assertDatabaseHas('admin_navigations', [
            'title' => $data['title'],
        ]);
    }

    /** @test */
    public function willThrow404IfAdminNavigationWeWantToUpdateIsNotFound(): void
    {
        $this->patchJson(route('admin.nav.update', ['nav' => -1]), $this->data())
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function willThrowValidationErrorWhileUpdatingAdminNavigationWithWrongInput(): void
    {
        $nav = $this->create('Iosum\AdminNav\Models\AdminNavigation');

        //title field is required
        $this->patchJson(route('admin.nav.update', ['nav' => $nav]), $this->data(['title' => '']))
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
        $this->patchJson(route('admin.nav.update', ['nav' => $nav]), $this->data(['title' => Str::random(70)]))
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
        $this->patchJson(route('admin.nav.update', ['nav' => $nav]), $this->data(['route_name' => '']))
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
        $this->patchJson(route('admin.nav.update', ['nav' => $nav]), $this->data(['route_path' => '']))
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
