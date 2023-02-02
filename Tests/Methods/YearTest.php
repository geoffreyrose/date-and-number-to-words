<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateTime;
use PHPUnit\Framework\TestCase;

class YearTest extends TestCase
{
    public function testYearInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('one thousand nine hundred ninety-nine', $words->year(1999));
        $this->assertNotEquals('one thousand nine hundred ninety-ninth', $words->year(1999));
    }

    public function testYearOrdinalInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('one thousand nine hundred ninety-nine', $words->year(1999, true));
        $this->assertEquals('one thousand nine hundred ninety-ninth', $words->year(1999, true));
    }

    public function testYearCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 1);

        $this->assertEquals('one thousand nine hundred ninety-nine', $words->year($carbon));
        $this->assertNotEquals('one thousand nine hundred ninety-ninth', $words->year($carbon));
    }

    public function testYearOrdinalCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 1);

        $this->assertNotEquals('one thousand nine hundred ninety-nine', $words->year($carbon, true));
        $this->assertEquals('one thousand nine hundred ninety-ninth', $words->year($carbon, true));
    }

    public function testYearDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 1);

        $this->assertEquals('one thousand nine hundred ninety-nine', $words->year($dateTime));
        $this->assertNotEquals('one thousand nine hundred ninety-ninth', $words->year($dateTime));
    }

    public function testYearOrdinalDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 1);

        $this->assertNotEquals('one thousand nine hundred ninety-nine', $words->year($dateTime, true));
        $this->assertEquals('one thousand nine hundred ninety-ninth', $words->year($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('Provide a valid year integer, Carbon object or PHP DateTime object', $words->year(999999999999999999 + 1));
        $this->assertNotEquals('1,000,000,000,000,000,000', $words->month(999999999999999999 + 1));
    }
}
