<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;

interface CreateAdminNavigationInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function createAdminNavigation(array $params);
}
