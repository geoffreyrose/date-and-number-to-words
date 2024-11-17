<?php

namespace DateAndNumberToWords\Facades;

class DateAndNumberToWords extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \DateAndNumberToWords\DateAndNumberToWords::class;
    }
}
