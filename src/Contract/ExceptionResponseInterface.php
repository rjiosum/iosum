<?php declare(strict_types=1);


namespace Iosum\ApiException\Contract;


interface ExceptionResponseInterface
{
    /**
     * @param $exception
     * @return mixed
     */
    public function response($exception);
}