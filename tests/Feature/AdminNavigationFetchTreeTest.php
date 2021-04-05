<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Iosum\AdminNav\Database\Seeders\AdminNavigationSeeder;
use Iosum\AdminNav\Tests\TestCase;

class AdminNavigationFetchTreeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canListAdminNavigationTreeResults(): void
    {
        (new AdminNavigationSeeder())->run();

        $this->getJson(route('admin.nav.tree'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
                        "types",
                        "id",
                        "attributes" => [
                            "title",
                            "icon",
                            "route_name",
                            "route_path",
                            "children",
                        ]
                    ],
                ],
                "links" => [
                    "self"
                ]
            ]);
    }
}
