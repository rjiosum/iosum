<?php declare(strict_types=1);

namespace Iosum\Base\Repositories;


interface BaseRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}