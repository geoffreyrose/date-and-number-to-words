<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
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
}
