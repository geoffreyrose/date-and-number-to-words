<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use PHPUnit\Framework\TestCase;

class YearTest extends TestCase
{
    public function test_year_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->year(1999);
        $this->assertEquals('one thousand nine hundred ninety-nine', $result);
        $this->assertNotEquals('one thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_year_ordinal_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->year(1999, true);
        $this->assertNotEquals('one thousand nine hundred ninety-nine', $result);
        $this->assertEquals('one thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_year_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 1);

        $result = $words->year($carbon);
        $this->assertEquals('one thousand nine hundred ninety-nine', $result);
        $this->assertNotEquals('one thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_year_ordinal_carbon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 1);

        $result = $words->year($carbon, true);
        $this->assertNotEquals('one thousand nine hundred ninety-nine', $result);
        $this->assertEquals('one thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_year_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 1);

        $result = $words->year($dateTime);
        $this->assertEquals('one thousand nine hundred ninety-nine', $result);
        $this->assertNotEquals('one thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_year_ordinal_date_time()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 1);

        $result = $words->year($dateTime, true);
        $this->assertNotEquals('one thousand nine hundred ninety-nine', $result);
        $this->assertEquals('one thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_invalid_argument_exception()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->year(999999999999999999 + 1);
    }

    public function test_invalid_argument_exception2()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->year(-999999999999999999 - 1);
    }
}
