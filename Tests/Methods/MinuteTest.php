<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateTime;
use PHPUnit\Framework\TestCase;

class MinuteTest extends TestCase
{
    public function testMinuteInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('forty-two', $words->minute(42));
        $this->assertNotEquals('forty-second', $words->minute(42));
    }

    public function testMinuteOrdinalInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('forty-two', $words->minute(42, true));
        $this->assertEquals('forty-second', $words->minute(42, true));
    }

    public function testMinuteCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $this->assertEquals('forty-two', $words->minute($carbon));
        $this->assertNotEquals('forty-second', $words->minute($carbon));
    }

    public function testMinuteOrdinalCarbon()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $this->assertNotEquals('forty-two', $words->minute($carbon, true));
        $this->assertEquals('forty-second', $words->minute($carbon, true));
    }

    public function testMinuteDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $this->assertEquals('forty-two', $words->minute($dateTime));
        $this->assertNotEquals('forty-second', $words->minute($dateTime));
    }

    public function testMinuteOrdinalDateTime()
    {
        $words = new DateAndNumberToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $this->assertNotEquals('forty-two', $words->minute($dateTime, true));
        $this->assertEquals('forty-second', $words->minute($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('Provide a valid minute integer (0-59), Carbon object or PHP DateTime object', $words->minute(66));
        $this->assertNotEquals('sixty-six', $words->minute(66));
    }
}
