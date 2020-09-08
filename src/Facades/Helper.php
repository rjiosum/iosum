<?php

namespace Iosum\Base\Facades;


use Illuminate\Support\Facades\Facade;


class Helper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'HelperService';
    }
}