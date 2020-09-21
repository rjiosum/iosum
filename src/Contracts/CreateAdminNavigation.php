<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;

interface CreateAdminNavigation
{
    /**
     * @param array $params
     * @return mixed
     */
    public function createAdminNavigation(array $params);
}
