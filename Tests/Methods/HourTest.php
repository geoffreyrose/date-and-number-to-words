<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use PHPUnit\Framework\TestCase;

class HourTest extends TestCase
{
    public function testHourInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('six', $words->hour(6));
        $this->assertNotEquals('sixth', $words->hour(6));
    }

    public function testHourOrdinalInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('six', $words->hour(6, true));
        $this->assertEquals('sixth', $words->hour(6, true));
    }

    public function testHourCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 24, 6, 42, 0);

        $this->assertEquals('six', $words->hour($carbon));
        $this->assertNotEquals('sixth', $words->hour($carbon));
    }

    public function testHourOrdinalCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 24, 6, 42, 0);

        $this->assertNotEquals('six', $words->hour($carbon, true));
        $this->assertEquals('sixth', $words->hour($carbon, true));
    }

    public function testHourDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(6, 42, 0);

        $this->assertEquals('six', $words->hour($dateTime));
        $this->assertNotEquals('sixth', $words->hour($dateTime));
    }

    public function testHourOrdinalDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(6, 42, 0);

        $this->assertNotEquals('six', $words->hour($dateTime, true));
        $this->assertEquals('sixth', $words->hour($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateAndNumberToWords();

        $this->expectException(InvalidUnitException::class);
        $words->hour(24);
    }

    public function testInvalidArgumentException2()
    {
        $words = new DateAndNumberToWords();

        $this->expectException(InvalidUnitException::class);
        $words->hour(-1);
    }
}
