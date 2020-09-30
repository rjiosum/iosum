<?php declare(strict_types=1);

namespace Iosum\AdminNav\Actions;

use Illuminate\Support\Facades\DB;
use Iosum\AdminNav\Contracts\CreateAdminNavigationInterface;
use Iosum\AdminNav\Models\AdminNavigation;

class CreateAdminNavigation implements CreateAdminNavigationInterface
{
    /**
     * @var AdminNavigation
     */
    private $adminNavigation;

    public function __construct(AdminNavigation $adminNavigation)
    {
        $this->adminNavigation = $adminNavigation;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createAdminNavigation(array $params)
    {
        $collection = collect($params);
        $position = $this->adminNavigation::max('position');
        $position = ($position) ? $position + 1 : 1;
        $merged = $collection->merge(['position' => $position]);

        return DB::transaction(function () use (&$merged) {
            $nav = $this->adminNavigation->create($merged->all());
            $nav->save();

            return $nav;
        }, 5);
    }
}
