<?php

use Carbon\Carbon;
use DateToWords\DateToWords;
use PHPUnit\Framework\TestCase;

class MinuteTest extends TestCase
{
    public function testMinuteInt()
    {
        $words = new DateToWords();

        $this->assertEquals('forty-two', $words->minute(42));
        $this->assertNotEquals('forty-second', $words->minute(42));
    }

    public function testMinuteOrdinalInt()
    {
        $words = new DateToWords();

        $this->assertNotEquals('forty-two', $words->minute(42, true));
        $this->assertEquals('forty-second', $words->minute(42, true));
    }

    public function testMinuteCarbon()
    {
        $words = new DateToWords();
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $this->assertEquals('forty-two', $words->minute($carbon));
        $this->assertNotEquals('forty-second', $words->minute($carbon));
    }

    public function testMinuteOrdinalCarbon()
    {
        $words = new DateToWords();
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $this->assertNotEquals('forty-two', $words->minute($carbon, true));
        $this->assertEquals('forty-second', $words->minute($carbon, true));
    }

    public function testMinuteDateTime()
    {
        $words = new DateToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $this->assertEquals('forty-two', $words->minute($dateTime));
        $this->assertNotEquals('forty-second', $words->minute($dateTime));
    }

    public function testMinuteOrdinalDateTime()
    {
        $words = new DateToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $this->assertNotEquals('forty-two', $words->minute($dateTime, true));
        $this->assertEquals('forty-second', $words->minute($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateToWords();

        $this->assertEquals('Provide a valid minute integer (0-59), Carbon object or PHP DateTime object', $words->minute(66));
        $this->assertNotEquals('sixty-six', $words->minute(66));
    }
}
