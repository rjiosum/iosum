<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;

interface UpdateAdminNavigationInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function updateAdminNavigation(array $params);
}
