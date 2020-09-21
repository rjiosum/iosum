<?php declare(strict_types=1);

namespace Iosum\AdminNav\Actions;

use Illuminate\Support\Facades\DB;
use Iosum\AdminNav\Contracts\UpdateAdminNavigation as UpdateAdminNavigationInterface;
use Iosum\AdminNav\Models\AdminNavigation;

class UpdateAdminNavigation implements UpdateAdminNavigationInterface
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
    public function updateAdminNavigation(array $params)
    {
        $collection = collect($params);

        return DB::transaction(function () use (&$collection) {
            return $this->adminNavigation
                ->where('id', $collection->get('id'))
                ->update($collection->except('id')->all());
        }, 5);
    }
}