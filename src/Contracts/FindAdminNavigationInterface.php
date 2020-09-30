<?php declare(strict_types=1);


namespace Iosum\AdminNav\Contracts;

interface FindAdminNavigationInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $uuid
     * @return mixed
     */
    public function findByUuid($uuid);
}
