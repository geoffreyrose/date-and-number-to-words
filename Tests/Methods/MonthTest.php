<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    public function test_month_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->month(10);
        $this->assertEquals('October', $result);
        $this->assertNotEquals('tenth', $result);
        $this->assertIsString($result);
    }

    public function test_month_ordinal_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->month(10, true);
        $this->assertNotEquals('October', $result);
        $this->assertEquals('tenth', $result);
        $this->assertIsString($result);
    }

    public function test_month_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 10, 24, 4, 42, 0);

        $result = $words->month($carbon);
        $this->assertEquals('October', $result);
        $this->assertNotEquals('tenth', $result);
        $this->assertIsString($result);
    }

    public function test_month_ordinal_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 10, 24, 4, 42, 0);

        $result = $words->month($carbon, true);
        $this->assertNotEquals('October', $result);
        $this->assertEquals('tenth', $result);
        $this->assertIsString($result);
    }

    public function test_month_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 10, 24)->setTime(4, 42, 0);

        $result = $words->month($dateTime);
        $this->assertEquals('October', $result);
        $this->assertNotEquals('tenth', $result);
        $this->assertIsString($result);
    }

    public function test_month_ordinal_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 10, 24)->setTime(4, 42, 0);

        $result = $words->month($dateTime, true);
        $this->assertNotEquals('October', $result);
        $this->assertEquals('tenth', $result);
        $this->assertIsString($result);
    }

    public function test_month_boundary_min()
    {
        $words = new DateAndNumberToWords;

        $result = $words->month(1);
        $this->assertEquals('January', $result);
        $this->assertIsString($result);
    }

    public function test_month_boundary_max()
    {
        $words = new DateAndNumberToWords;

        $result = $words->month(12);
        $this->assertEquals('December', $result);
        $this->assertIsString($result);
    }

    public function test_invalid_argument_exception()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->month(13);
    }

    public function test_invalid_argument_exception2()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->month(0);
    }
}
