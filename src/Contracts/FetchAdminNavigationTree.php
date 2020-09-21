<?php declare(strict_types=1);

namespace Iosum\AdminNav\Contracts;

interface FetchAdminNavigationTree
{
    /**
     * @return mixed
     */
    public function getTree();
}