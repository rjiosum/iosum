<?php declare(strict_types=1);

namespace Iosum\AdminNav\Actions;

use Illuminate\Support\Facades\DB;
use Iosum\AdminNav\Contracts\DeleteAdminNavigation as DeleteAdminNavigationInterface;
use Iosum\AdminNav\Models\AdminNavigation;

class DeleteAdminNavigation implements DeleteAdminNavigationInterface
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
     * @param int $id
     * @return mixed
     */
    public function deleteAdminNavigation(int $id)
    {
        return DB::transaction(function () use (&$id) {
            return $this->adminNavigation->where('id', $id)->delete();
        });
    }
}
