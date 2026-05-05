<?php

namespace Tests\Methods;

use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function test_number_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->number(999999999999999999);
        $this->assertEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-nine', $result);
        $this->assertNotEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_number_ordinal_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->number(999999999999999999, true);
        $this->assertNotEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-nine', $result);
        $this->assertEquals('nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_number_float()
    {
        $words = new DateAndNumberToWords;

        $result = $words->number(12.123);
        $this->assertNotEquals('12.123', $result);
        $this->assertEquals('twelve point one two three', $result);
        $this->assertIsString($result);
    }

    public function test_number_ordinal_float()
    {
        $words = new DateAndNumberToWords;

        $result = $words->number(12.123, true);
        $this->assertNotEquals('12.123', $result);
        $this->assertEquals('twelve point one two three', $result);
        $this->assertIsString($result);
    }

    public function test_number_zero()
    {
        $words = new DateAndNumberToWords;

        $result = $words->number(0);
        $this->assertEquals('zero', $result);
        $this->assertIsString($result);
    }

    public function test_number_negative_int()
    {
        $words = new DateAndNumberToWords;

        $result = $words->number(-42);
        $this->assertEquals('minus forty-two', $result);
        $this->assertIsString($result);
    }

    public function test_number_negative_float()
    {
        $words = new DateAndNumberToWords;

        $result = $words->number(-12.5);
        $this->assertEquals('minus twelve point five', $result);
        $this->assertIsString($result);
    }

    public function test_invalid_argument_exception()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->number(999999999999999999 + 1);
    }

    public function test_invalid_argument_exception2()
    {
        $words = new DateAndNumberToWords;

        $this->expectException(InvalidUnitException::class);
        $words->number(-999999999999999999 - 1);
    }
}
