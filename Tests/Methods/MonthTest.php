<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateTime;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    public function testMonthInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('October', $words->month(10));
        $this->assertNotEquals('tenth', $words->month(10));
    }

    public function testMonthOrdinalInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('October', $words->month(10, true));
        $this->assertEquals('tenth', $words->month(10, true));
    }

    public function testMonthCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 10, 24, 4, 42, 0);

        $this->assertEquals('October', $words->month($carbon));
        $this->assertNotEquals('tenth', $words->month($carbon));
    }

    public function testMonthOrdinalCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 10, 24, 4, 42, 0);

        $this->assertNotEquals('October', $words->month($carbon, true));
        $this->assertEquals('tenth', $words->month($carbon, true));
    }

    public function testMonthDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 10, 24)->setTime(4, 42, 0);

        $this->assertEquals('October', $words->month($dateTime));
        $this->assertNotEquals('tenth', $words->month($dateTime));
    }

    public function testMonthOrdinalDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 10, 24)->setTime(4, 42, 0);

        $this->assertNotEquals('October', $words->month($dateTime, true));
        $this->assertEquals('tenth', $words->month($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('Provide a valid month integer (1-12), Carbon object or PHP DateTime object', $words->month(0));
        $this->assertNotEquals('zero', $words->month(0));
    }
}
