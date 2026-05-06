<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidFormatException;
use PHPUnit\Framework\TestCase;

class WordsTest extends TestCase
{
    public function test_words_mixed_string()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Do of M, Y');
        $this->assertEquals('first of April, two thousand twenty-three', $result);
        $this->assertIsString($result);
    }

    public function test_words_yo()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Yo');
        $this->assertEquals('two thousand twenty-third', $result);
        $this->assertIsString($result);
    }

    public function test_words_y()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Y');
        $this->assertEquals('two thousand twenty-three', $result);
        $this->assertIsString($result);
    }

    public function test_words_mo()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Mo');
        $this->assertEquals('fourth', $result);
        $this->assertIsString($result);
    }

    public function test_words_m()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'M');
        $this->assertEquals('April', $result);
        $this->assertIsString($result);
    }

    public function test_words_do()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Do');
        $this->assertEquals('first', $result);
        $this->assertIsString($result);
    }

    public function test_words_d()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'D');
        $this->assertEquals('one', $result);
        $this->assertIsString($result);
    }

    public function test_words_ho()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Ho');
        $this->assertEquals('seventh', $result);
        $this->assertIsString($result);
    }

    public function test_words_h()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'H');
        $this->assertEquals('seven', $result);
        $this->assertIsString($result);
    }

    public function test_words_lowercase_ho()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 14, 42, 8);

        $result = $words->words($carbon, 'ho');
        $this->assertEquals('second', $result);
        $this->assertIsString($result);
    }

    public function test_words_lowercase_h()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 14, 42, 8);

        $result = $words->words($carbon, 'h');
        $this->assertEquals('two', $result);
        $this->assertIsString($result);
    }

    public function test_words_io()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Io');
        $this->assertEquals('forty-second', $result);
        $this->assertIsString($result);
    }

    public function test_words_i()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'I');
        $this->assertEquals('forty-two', $result);
        $this->assertIsString($result);
    }

    public function test_words_so()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'So');
        $this->assertEquals('eighth', $result);
        $this->assertIsString($result);
    }

    public function test_words_s()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'S');
        $this->assertEquals('eight', $result);
        $this->assertIsString($result);
    }

    public function test_words_a()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'A');
        $this->assertEquals('AM', $result);
        $this->assertIsString($result);
    }

    public function test_words_empty_format()
    {
        $this->expectException(InvalidFormatException::class);

        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $words->words($carbon, '');
    }

    public function test_words_format_too_long()
    {
        $this->expectException(InvalidFormatException::class);

        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $words->words($carbon, str_repeat('Y', 1025));
    }

    public function test_words_passthrough_only()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'hello');
        $this->assertEquals('hello', $result);
        $this->assertIsString($result);
    }

    public function test_words_datetime_object()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new \DateTime;
        $dateTime->setDate(2023, 4, 1)->setTime(7, 42, 8);

        $result = $words->words($dateTime, 'Do of M, Y');
        $this->assertEquals('first of April, two thousand twenty-three', $result);
        $this->assertIsString($result);
    }
}
