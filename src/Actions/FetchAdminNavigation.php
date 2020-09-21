<?php declare(strict_types=1);


namespace Iosum\AdminNav\Actions;

use Iosum\AdminNav\Contracts\FetchAdminNavigation as FetchAdminNavigationInterface;
use Iosum\AdminNav\Models\AdminNavigation;

class FetchAdminNavigation implements FetchAdminNavigationInterface
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
     * @param $parentId
     * @return mixed
     */
    public function get($parentId)
    {
        return $this->adminNavigation::where('parent_id', '=', $parentId)->orderByDesc('position')->paginate(3);
    }
}
