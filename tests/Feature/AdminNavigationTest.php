<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Iosum\AdminNav\Database\Seeders\AdminNavigationSeeder;
use Iosum\AdminNav\Tests\TestCase;
use Laravel\Passport\Passport;

class AdminNavigationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected $admin;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->create('Iosum\AdminAuth\Models\Admin',  ['email' => 'raj@test.com']);
        Passport::actingAs($this->admin, [], 'api:admin');
    }

    /** @test */
    public function canListAdminNavigationTreeResults(): void
    {
        (new AdminNavigationSeeder())->run();

        $this->getJson(route('admin.nav.tree'))
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
                        "id",
                        "uuid",
                        "title",
                        "icon",
                        "route",
                        "created_at",
                        "updated_at",
                        "created",
                        "updated",
                        "children",
                    ],
                ],
            ]);
    }

    /** @test */
    public function canListCollectionOfPaginatedAdminNavigationResults(): void
    {
        (new AdminNavigationSeeder())->run();

        //Top Navigation
        $this->getJson(route('admin.nav'))
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
                        "id",
                        "uuid",
                        "title",
                        "icon",
                        "route",
                        "created_at",
                        "updated_at",
                        "created",
                        "updated",
                    ],
                ],
                "links" => ["first", "last", "prev", "next"],
                "meta" => [
                    "current_page", "last_page", "from", "to",
                    "path", "per_page", "total",
                ],
            ]);

        //Sub Category
        $this->getJson(route('admin.nav', ['parentId' => 2]))
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
                        "id",
                        "uuid",
                        "title",
                        "icon",
                        "route",
                        "created_at",
                        "updated_at",
                        "created",
                        "updated",
                    ],
                ],
                "links" => ["first", "last", "prev", "next"],
                "meta" => [
                    "current_page", "last_page", "from", "to",
                    "path", "per_page", "total",
                ],
            ]);
    }

    /** @test */
    public function willThrowValidationErrorWhileCreatingAdminNavigationWithWrongInput(): void
    {
        //title field is required
        $this->postJson(route('admin.nav.store'), $this->data(['title' => '']))
            ->assertStatus(422)
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
            ->assertStatus(422)
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
            ->assertStatus(422)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'route' => [
                        trans('validation.required', ['attribute' => 'route']),
                    ],
                ],
            ]);
    }

    /** @test */
    public function canStoreAdminNavigation(): void
    {
        $this->withoutExceptionHandling();
        $this->postJson(route('admin.nav.store'), $data = $this->data())
            ->assertStatus(202)
            ->assertJsonStructure([
                "status",
                "data" => [
                    "id",
                    "uuid",
                    "title",
                    "icon",
                    "route",
                    "created_at",
                    "updated_at",
                    "created",
                    "updated",
                ],
                "message",
            ])
            ->assertJson([
                "status" => true,
                "data" => [
                    "title" => $data['title'],
                    "route" => $data['route'],
                ],
                "message" => trans('base::response.success.create', ['attribute' => 'Navigation']),
            ]);

        $this->assertDatabaseHas('admin_navigations', [
            "title" => $data["title"],
            "route" => $data['route'],
        ]);
    }

    /** @test */
    public function willThrowValidationErrorWhileUpdatingAdminNavigationWithWrongInput(): void
    {
        $nav = $this->create('Iosum\AdminNav\Models\AdminNavigation');

        //title field is required
        $this->patchJson(route('admin.nav.update', ['nav' => $nav]), $this->data(['title' => '']))
            ->assertStatus(422)
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
            ->assertStatus(422)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'title' => [
                        trans('validation.max.string', ['attribute' => 'title', 'max' => 50]),
                    ],
                ],
            ]);

        //route field is required
        $this->patchJson(route('admin.nav.update', ['nav' => $nav]), $this->data(['route' => '']))
            ->assertStatus(422)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'route' => [
                        trans('validation.required', ['attribute' => 'route']),
                    ],
                ],
            ]);
    }

    /** @test */
    public function willThrow404IfAdminNavigationWeWantToUpdateIsNotFound(): void
    {
        $this->patchJson(route('admin.nav.update', ['nav' => -1]), $this->data())
            ->assertStatus(404);
    }

    /** @test */
    public function canUpdateAdminNavigation(): void
    {
        $nav = $this->create('Iosum\AdminNav\Models\AdminNavigation');

        $this->patchJson(
            route('admin.nav.update', ['nav' => $nav]),
            $data = $this->data(['title' => 'This is a new title'])
        )

             ->assertJson([
                'status' => true,
                'data' => [
                    'title' => $data['title'],

                ],
                'message' => trans('base::response.success.update', ['attribute' => 'Navigation']),
            ])
            ->assertJsonStructure([
                'status',
                'data' => [
                    "id",
                    "uuid",
                    "title",
                    "icon",
                    "route",
                    "created_at",
                    "updated_at",
                    "created",
                    "updated",
                ],
                'message',
            ])
            ->assertStatus(202);

        $this->assertDatabaseHas('admin_navigations', [
            'title' => $data['title'],
        ]);
    }

    /** @test */
    public function willThrow404ErrorIfAdminNavigationWeAreTryingToDeleteDoesNotExists(): void
    {
        $this->deleteJson(route('admin.nav.destroy', -1))
            ->assertStatus(404);
    }

    /** @test */
    public function canDeleteAdminNavigation(): void
    {
        $nav = $this->create('Iosum\AdminNav\Models\AdminNavigation');

        $this->deleteJson(route('admin.nav.destroy', ['nav' => $nav]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'status', 'message',
            ])->assertJson([
                'status' => true,
                'message' => trans('base::response.success.delete', ['attribute' => 'Navigation']),
            ]);
        $this->assertDatabaseMissing('admin_navigations', ['id' => $nav->id]);
    }

    private function data($data = []): array
    {
        return [
            'parent_id' => $data['parent_id'] ?? 0,
            'position' => $data['position'] ?? 1,
            'title' => $data['title'] ?? $this->faker->text(40),
            'route' => $data['route'] ?? 'na',
        ];
    }
}
