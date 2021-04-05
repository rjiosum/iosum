<?php declare(strict_types=1);


namespace Iosum\AdminNav\Actions;

use Iosum\AdminNav\Contracts\FetchAdminNavigationInterface;
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
     * @param int $perPage
     * @param string $sortBy
     * @param string $sortDirection
     * @return mixed
     */
    public function get($parentId, $perPage = 3, $sortBy = 'id', $sortDirection = 'desc')
    {
        return $this->adminNavigation::where('parent_id', '=', $parentId)
            ->withCount('children')
            ->with('parent')
            ->orderBy($sortBy, $sortDirection)->paginate($perPage);
    }
}
