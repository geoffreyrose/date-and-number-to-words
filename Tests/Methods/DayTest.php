<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateTime;
use PHPUnit\Framework\TestCase;

class DayTest extends TestCase
{
    public function testDayInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('twenty-four', $words->day(24));
        $this->assertNotEquals('twenty-fourth', $words->day(24));
    }

    public function testDayOrdinalInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('twenty-four', $words->day(24, true));
        $this->assertEquals('twenty-fourth', $words->day(24, true));
    }

    public function testDayCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 24);

        $this->assertEquals('twenty-four', $words->day($carbon));
        $this->assertNotEquals('twenty-fourth', $words->day($carbon));
    }

    public function testDayOrdinalCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 24);

        $this->assertNotEquals('twenty-four', $words->day($carbon, true));
        $this->assertEquals('twenty-fourth', $words->day($carbon, true));
    }

    public function testDayDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24);

        $this->assertEquals('twenty-four', $words->day($dateTime));
        $this->assertNotEquals('twenty-fourth', $words->day($dateTime));
    }

    public function testDayOrdinalDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24);

        $this->assertNotEquals('twenty-four', $words->day($dateTime, true));
        $this->assertEquals('twenty-fourth', $words->day($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('Provide a valid day integer (1-31), Carbon object or PHP DateTime object', $words->day(42));
        $this->assertNotEquals('forty-second', $words->day(42));
    }
}
