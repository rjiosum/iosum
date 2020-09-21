<?php declare(strict_types=1);

namespace Iosum\AdminNav\Database\Factories;

use Iosum\AdminNav\Models\AdminNavigation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminNavigationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminNavigation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => 0,
            'position' => 1,
            'title' => $this->faker->text(45),
            'icon' => 'fa-users',
            'route' => 'na',
        ];
    }
}