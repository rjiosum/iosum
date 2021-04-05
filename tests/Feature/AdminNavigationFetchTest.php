<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Iosum\AdminNav\Database\Seeders\AdminNavigationSeeder;
use Iosum\AdminNav\Tests\TestCase;


class AdminNavigationFetchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canListCollectionOfPaginatedAdminNavigationResults(): void
    {
        (new AdminNavigationSeeder())->run();

        //Top Navigation
        $this->getJson(route('admin.nav'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
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
                        ],
                    ],
                ],
                "links" => [
                    "self",
                    "first",
                    "last",
                    "prev",
                    "next"
                ],
                "meta" => [
                    "current_page",
                    "from",
                    "last_page",
                    "links" => [
                        "*" => [
                            "url",
                            "label",
                            "active"
                        ]
                    ],
                    "path",
                    "per_page",
                    "to",
                    "total",
                ],
            ]);

        //Sub Category
        $this->getJson(route('admin.nav', ['parentId' => 2]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
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
                        ],
                    ]
                ],
                "links" => [
                    "self",
                    "first",
                    "last",
                    "prev",
                    "next"
                ],
                "meta" => [
                    "current_page",
                    "from",
                    "last_page",
                    "links" => [
                        "*" => [
                            "url",
                            "label",
                            "active"
                        ]
                    ],
                    "path",
                    "per_page",
                    "to",
                    "total",
                ],
            ]);
    }
}
