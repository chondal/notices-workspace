<?php


namespace Chondal\NoticesWorkspace\Facades;

use Illuminate\Support\Facades\Facade;


class NoticesWorkspace extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'notices-workspace';
    }
}
