<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Database\Seeders;

use Iosum\AdminAuth\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@gmail.com',
        ]);

        Admin::factory()->create([
            'first_name' => 'Oliver',
            'last_name' => 'Bernard',
            'email' => 'oli@gmail.com',
        ]);

    }
}
