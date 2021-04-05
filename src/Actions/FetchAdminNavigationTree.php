<?php declare(strict_types=1);

namespace Iosum\AdminNav\Actions;

use Iosum\AdminNav\Contracts\FetchAdminNavigationTreeInterface;
use Iosum\AdminNav\Models\AdminNavigation;

class FetchAdminNavigationTree implements FetchAdminNavigationTreeInterface
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
     * @return mixed
     */
    public function getTree()
    {
        return $this->adminNavigation::with('children')->parents()->ordered()->get();
    }
}
