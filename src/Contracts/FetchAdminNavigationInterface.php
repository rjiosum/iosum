<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;

interface FetchAdminNavigationInterface
{
    /**
     * @param $parentId
     * @return mixed
     */
    public function get($parentId);
}
