<?php declare(strict_types=1);

namespace Iosum\AdminNav\Database\Seeders;

use Illuminate\Database\Seeder;
use Iosum\AdminNav\Models\AdminNavigation;

class AdminNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $op = $ip = 1;

        $id = AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => $op,
            'title' => 'Settings',
            'icon' => 'fa-cogs',
            'route' => 'na'
        ])->id;


        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => $ip,
            'title' => 'Country',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Currency',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Vat',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Out Of Stock Messages',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Social Networking',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Reference Prefix',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Email Template',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Watermark Image',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Image Dimensions',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        unset($id);


        $id = AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'Frontend Settings',
            'icon' => 'fa-palette',
            'route' => 'na'
        ])->id;


        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Template',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Site Logo',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Home Page Banners',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Static Pages',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        unset($id);

        $id = AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'Merchant Settings',
            'icon' => 'fa-user-cog',
            'route' => 'na'
        ])->id;


        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Merchant Info',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Couriers',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Payment Option',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Shipping',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        unset($id);

        $id = AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'Taxonomy',
            'icon' => 'fa-sitemap',
            'route' => 'na'
        ])->id;


        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Manage Category',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);
        unset($id);

        $id = AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'Products',
            'icon' => 'fa-toolbox',
            'route' => 'na'
        ])->id;


        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Manufacturer / Brand',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Suppliers',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Product Feed',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Product Line',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Product Attributes',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Product Reviews',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => $id,
            'position' => ++$ip,
            'title' => 'Product Q&A',
            'icon' => 'fa-code-branch',
            'route' => 'na'
        ]);

        unset($id);

        AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'Orders',
            'icon' => 'fa-coins',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'Customers',
            'icon' => 'fa-people-arrows',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'Management',
            'icon' => 'fa-school',
            'route' => 'na'
        ]);

        AdminNavigation::factory()->create([
            'parent_id' => 0,
            'position' => ++$op,
            'title' => 'System',
            'icon' => 'fa-tools',
            'route' => 'na'
        ]);
    }
}
