<?php

use Carbon\Carbon;
use DateToWords\DateToWords;
use PHPUnit\Framework\TestCase;

class SecondTest extends TestCase
{
    public function testSecondInt()
    {
        $words = new DateToWords();

        $this->assertEquals('zero', $words->second(0));
        $this->assertNotEquals('zeroth', $words->second(0));
    }

    public function testSecondOrdinalInt()
    {
        $words = new DateToWords();

        $this->assertNotEquals('zero', $words->second(0, true));
        $this->assertEquals('zeroth', $words->second(0, true));
    }

    public function testSecondCarbon()
    {
        $words = new DateToWords();
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $this->assertEquals('zero', $words->second($carbon));
        $this->assertNotEquals('zeroth', $words->second($carbon));
    }

    public function testSecondOrdinalCarbon()
    {
        $words = new DateToWords();
        $carbon = Carbon::create(1999, 1, 24, 4, 42, 0);

        $this->assertNotEquals('zero', $words->second($carbon, true));
        $this->assertEquals('zeroth', $words->second($carbon, true));
    }

    public function testSecondDateTime()
    {
        $words = new DateToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $this->assertEquals('zero', $words->second($dateTime));
        $this->assertNotEquals('zeroth', $words->second($dateTime));
    }

    public function testSecondOrdinalDateTime()
    {
        $words = new DateToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(4, 42, 0);

        $this->assertNotEquals('zero', $words->second($dateTime, true));
        $this->assertEquals('zeroth', $words->second($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateToWords();

        $this->assertEquals('Provide a valid second integer (0-59), Carbon object or PHP DateTime object', $words->second(66));
        $this->assertNotEquals('sixty-six', $words->second(66));
    }
}
