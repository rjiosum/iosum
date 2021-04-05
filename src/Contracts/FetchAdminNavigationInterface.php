<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;

interface FetchAdminNavigationInterface
{
    /**
     * @param $parentId
     * @param int $perPage
     * @param string $sortBy
     * @param string $sortDirection
     * @return mixed
     */
    public function get($parentId, $perPage = 3, $sortBy = 'id', $sortDirection = 'desc');
}
