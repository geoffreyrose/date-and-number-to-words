<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use PHPUnit\Framework\TestCase;

class MinuteTest extends TestCase
{
    public function test_minute_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->minute(42);
        $this->assertEquals('forty-two', $result);
        $this->assertNotEquals('forty-second', $result);
        $this->assertIsString($result);
    }

    public function test_minute_ordinal_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->minute(42, true);
        $this->assertNotEquals('forty-two', $result);
        $this->assertEquals('forty-second', $result);
        $this->assertIsString($result);
    }

    public function test_minute_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $result = $words->minute($carbon);
        $this->assertEquals('forty-two', $result);
        $this->assertNotEquals('forty-second', $result);
        $this->assertIsString($result);
    }

    public function test_minute_ordinal_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $result = $words->minute($carbon, true);
        $this->assertNotEquals('forty-two', $result);
        $this->assertEquals('forty-second', $result);
        $this->assertIsString($result);
    }

    public function test_minute_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $result = $words->minute($dateTime);
        $this->assertEquals('forty-two', $result);
        $this->assertNotEquals('forty-second', $result);
        $this->assertIsString($result);
    }

    public function test_minute_ordinal_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $result = $words->minute($dateTime, true);
        $this->assertNotEquals('forty-two', $result);
        $this->assertEquals('forty-second', $result);
        $this->assertIsString($result);
    }

    public function test_minute_boundary_min()
    {
        $words = new DateAndNumberToWords;

        $result = $words->minute(0);
        $this->assertEquals('zero', $result);
        $this->assertIsString($result);
    }

    public function test_minute_boundary_max()
    {
        $words = new DateAndNumberToWords;

        $result = $words->minute(59);
        $this->assertEquals('fifty-nine', $result);
        $this->assertIsString($result);
    }

    public function test_invalid_argument_exception()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->minute(61);
    }

    public function test_invalid_argument_exception2()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->minute(-1);
    }
}
