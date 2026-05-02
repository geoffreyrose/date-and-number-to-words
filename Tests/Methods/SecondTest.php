<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use PHPUnit\Framework\TestCase;

class SecondTest extends TestCase
{
    public function test_second_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->second(0);
        $this->assertEquals('zero', $result);
        $this->assertNotEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_second_ordinal_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->second(0, true);
        $this->assertNotEquals('zero', $result);
        $this->assertEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_second_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $result = $words->second($carbon);
        $this->assertEquals('zero', $result);
        $this->assertNotEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_second_ordinal_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $result = $words->second($carbon, true);
        $this->assertNotEquals('zero', $result);
        $this->assertEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_second_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $result = $words->second($dateTime);
        $this->assertEquals('zero', $result);
        $this->assertNotEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_second_ordinal_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $result = $words->second($dateTime, true);
        $this->assertNotEquals('zero', $result);
        $this->assertEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_invalid_argument_exception()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->second(66);
    }

    public function test_invalid_argument_exception2()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->second(-1);
    }
}
