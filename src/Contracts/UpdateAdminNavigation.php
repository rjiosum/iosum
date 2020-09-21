<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;


interface UpdateAdminNavigation
{
    /**
     * @param array $params
     * @return mixed
     */
    public function updateAdminNavigation(array $params);
}