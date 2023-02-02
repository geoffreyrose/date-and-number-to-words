<?php

namespace Tests\Methods;

use DateAndNumberToWords\DateAndNumberToWords;
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

    public function testInvalidArgumentException()
    {
        $words = new DateAndNumberToWords();

        $this->assertEquals('Provide a valid integer. Must to between 999999999999999999 and -999999999999999999', $words->number(999999999999999999 + 1));
        $this->assertEquals('Provide a valid integer. Must to between 999999999999999999 and -999999999999999999', $words->number(-999999999999999999 - 1));
    }
}
