<?php

namespace DateAndNumberToWords\Facades;

use Illuminate\Support\Facades\Facade;

class DateAndNumberToWords extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DateAndNumberToWords\DateAndNumberToWords::class;
    }
}
