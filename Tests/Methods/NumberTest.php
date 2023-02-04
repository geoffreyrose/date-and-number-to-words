<?php

namespace Tests\Methods;

use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function testNumberInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-nine', $words->number(999999999999999999));
        $this->assertNotEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-ninth', $words->number(999999999999999999));
    }

    public function testNumberOrdinalInt()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-nine', $words->number(999999999999999999, true));
        $this->assertEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-ninth', $words->number(999999999999999999, true));
    }

    public function testNumberFloat()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('12.123', $words->number(12.123));
        $this->assertEquals('twelve point one two three', $words->number(12.123));
    }

    public function testNumberOrdinalFloat()
    {
        $words = new DateAndNumberToWords();

        $this->assertNotEquals('12.123', $words->number(12.123, true));
        $this->assertEquals('twelve point one two three', $words->number(12.123, true));
    }

    public function testInvalidArgumentException()
    {
        $words = new DateAndNumberToWords();

        $this->expectException(InvalidUnitException::class);
        $words->number(999999999999999999 + 1);
    }

    public function testInvalidArgumentException2()
    {
        $words = new DateAndNumberToWords();

        $this->expectException(InvalidUnitException::class);
        $words->number(-999999999999999999 - 1);
    }
}
