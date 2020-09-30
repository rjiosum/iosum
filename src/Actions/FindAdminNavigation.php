<?php declare(strict_types=1);


namespace Iosum\AdminNav\Actions;

use Iosum\AdminNav\Contracts\FindAdminNavigationInterface;
use Iosum\AdminNav\Models\AdminNavigation;

class FindAdminNavigation implements FindAdminNavigationInterface
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
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->adminNavigation->findOrFail($id);
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function findByUuid($uuid)
    {
        return $this->adminNavigation->findOrFail($uuid);
    }
}
