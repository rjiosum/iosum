<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Iosum\AdminNav\Tests\TestCase;

class AdminNavigationDestroyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function willThrow404ErrorIfAdminNavigationWeAreTryingToDeleteDoesNotExists(): void
    {
        $this->deleteJson(route('admin.nav.destroy', -1))
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function canDeleteAdminNavigation(): void
    {
        $nav = $this->create('Iosum\AdminNav\Models\AdminNavigation');

        $this->deleteJson(route('admin.nav.destroy', ['nav' => $nav]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'status', 'message',
            ])->assertJson([
                'status' => true,
                'message' => trans('base::response.success.delete', ['attribute' => 'Navigation']),
            ]);

        $this->assertDatabaseMissing('admin_navigations', ['id' => $nav->id]);
    }
}
