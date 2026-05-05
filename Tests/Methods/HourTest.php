<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use PHPUnit\Framework\TestCase;

class HourTest extends TestCase
{
    public function test_hour_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->hour(6);
        $this->assertEquals('six', $result);
        $this->assertNotEquals('sixth', $result);
        $this->assertIsString($result);
    }

    public function test_hour_ordinal_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->hour(6, true);
        $this->assertNotEquals('six', $result);
        $this->assertEquals('sixth', $result);
        $this->assertIsString($result);
    }

    public function test_hour_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 6, 42, 0);

        $result = $words->hour($carbon);
        $this->assertEquals('six', $result);
        $this->assertNotEquals('sixth', $result);
        $this->assertIsString($result);
    }

    public function test_hour_ordinal_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 6, 42, 0);

        $result = $words->hour($carbon, true);
        $this->assertNotEquals('six', $result);
        $this->assertEquals('sixth', $result);
        $this->assertIsString($result);
    }

    public function test_hour_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(6, 42, 0);

        $result = $words->hour($dateTime);
        $this->assertEquals('six', $result);
        $this->assertNotEquals('sixth', $result);
        $this->assertIsString($result);
    }

    public function test_hour_ordinal_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(6, 42, 0);

        $result = $words->hour($dateTime, true);
        $this->assertNotEquals('six', $result);
        $this->assertEquals('sixth', $result);
        $this->assertIsString($result);
    }

    public function test_hour_boundary_min()
    {
        $words = new DateAndNumberToWords;

        $result = $words->hour(0);
        $this->assertEquals('zero', $result);
        $this->assertIsString($result);
    }

    public function test_hour_boundary_max()
    {
        $words = new DateAndNumberToWords;

        $result = $words->hour(23);
        $this->assertEquals('twenty-three', $result);
        $this->assertIsString($result);

        $result = $words->hour(Carbon::now()->setHour(23));
        $this->assertEquals('twenty-three', $result);
        $this->assertIsString($result);
    }

    public function test_invalid_argument_exception()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->hour(24);
    }

    public function test_invalid_argument_exception2()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->hour(-1);
    }
}
