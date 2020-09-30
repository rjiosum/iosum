<?php declare(strict_types=1);

namespace Iosum\AdminNav\Contracts;

interface FetchAdminNavigationTreeInterface
{
    /**
     * @return mixed
     */
    public function getTree();
}
