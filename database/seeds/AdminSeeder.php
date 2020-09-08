<?php
namespace Iosum\AdminAuth\Database\Seeds;

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
        factory(Admin::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@gmail.com',
        ]);

        factory(Admin::class)->create([
            'first_name' => 'Oliver',
            'last_name' => 'Bernard',
            'email' => 'oli@gmail.com',
        ]);

    }
}
