<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use PHPUnit\Framework\TestCase;

class DayTest extends TestCase
{
    public function test_day_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->day(24);
        $this->assertEquals('twenty-four', $result);
        $this->assertNotEquals('twenty-fourth', $result);
        $this->assertIsString($result);
    }

    public function test_day_ordinal_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->day(24, true);
        $this->assertNotEquals('twenty-four', $result);
        $this->assertEquals('twenty-fourth', $result);
        $this->assertIsString($result);
    }

    public function test_day_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24);

        $result = $words->day($carbon);
        $this->assertEquals('twenty-four', $result);
        $this->assertNotEquals('twenty-fourth', $result);
        $this->assertIsString($result);
    }

    public function test_day_ordinal_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24);

        $result = $words->day($carbon, true);
        $this->assertNotEquals('twenty-four', $result);
        $this->assertEquals('twenty-fourth', $result);
        $this->assertIsString($result);
    }

    public function test_day_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24);

        $result = $words->day($dateTime);
        $this->assertEquals('twenty-four', $result);
        $this->assertNotEquals('twenty-fourth', $result);
        $this->assertIsString($result);
    }

    public function test_day_ordinal_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24);

        $result = $words->day($dateTime, true);
        $this->assertNotEquals('twenty-four', $result);
        $this->assertEquals('twenty-fourth', $result);
        $this->assertIsString($result);
    }

    public function test_invalid_argument_exception()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->day(32);
    }

    public function test_invalid_argument_exception2()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->day(0);
    }
}
