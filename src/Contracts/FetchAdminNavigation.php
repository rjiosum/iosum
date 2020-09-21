<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;


interface FetchAdminNavigation
{
    /**
     * @param $parentId
     * @return mixed
     */
    public function get($parentId);
}