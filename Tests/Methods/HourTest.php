<?php

use Carbon\Carbon;
use DateToWords\DateToWords;
use PHPUnit\Framework\TestCase;

class HourTest extends TestCase
{
    public function testHourInt()
    {
        $words = new DateToWords();

        $this->assertEquals('six', $words->hour(6));
        $this->assertNotEquals('sixth', $words->hour(6));
    }

    public function testHourOrdinalInt()
    {
        $words = new DateToWords();

        $this->assertNotEquals('six', $words->hour(6, true));
        $this->assertEquals('sixth', $words->hour(6, true));
    }

    public function testHourCarbon()
    {
        $words = new DateToWords();
        $carbon = Carbon::create(1999, 1, 24, 6, 42, 0);

        $this->assertEquals('six', $words->hour($carbon));
        $this->assertNotEquals('sixth', $words->hour($carbon));
    }

    public function testHourOrdinalCarbon()
    {
        $words = new DateToWords();
        $carbon = Carbon::create(1999, 1, 24, 6, 42, 0);

        $this->assertNotEquals('six', $words->hour($carbon, true));
        $this->assertEquals('sixth', $words->hour($carbon, true));
    }

    public function testHourDateTime()
    {
        $words = new DateToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(6, 42, 0);

        $this->assertEquals('six', $words->hour($dateTime));
        $this->assertNotEquals('sixth', $words->hour($dateTime));
    }

    public function testHourOrdinalDateTime()
    {
        $words = new DateToWords();
        $dateTime = new DateTime();
        $dateTime->setDate(1999, 1, 24)->setTime(6, 42, 0);

        $this->assertNotEquals('six', $words->hour($dateTime, true));
        $this->assertEquals('sixth', $words->hour($dateTime, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateToWords();

        $this->assertEquals('Provide a valid hour integer (0-23), Carbon object or PHP DateTime object', $words->hour(66));
        $this->assertNotEquals('sixty-six', $words->hour(66));
    }
}
