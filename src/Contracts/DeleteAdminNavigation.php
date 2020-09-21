<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;


interface DeleteAdminNavigation
{
    /**
     * @param int $id
     * @return mixed
     */
    public function deleteAdminNavigation(int $id);
}