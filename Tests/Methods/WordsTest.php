<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use PHPUnit\Framework\TestCase;

class WordsTest extends TestCase
{
    public function testWordsMixedString()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('first of April, two thousand twenty-three', $words->words($carbon, 'Do of M, Y'));
    }

    public function testWordsYo()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('two thousand twenty-third', $words->words($carbon, 'Yo'));
    }

    public function testWordsY()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('two thousand twenty-three', $words->words($carbon, 'Y'));
    }

    public function testWordsMo()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('fourth', $words->words($carbon, 'Mo'));
    }

    public function testWordsM()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('April', $words->words($carbon, 'M'));
    }

    public function testWordsDo()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('first', $words->words($carbon, 'Do'));
    }

    public function testWordsD()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('one', $words->words($carbon, 'D'));
    }

    public function testWordsHo()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('seventh', $words->words($carbon, 'Ho'));
    }

    public function testWordsH()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('seven', $words->words($carbon, 'H'));
    }

    public function testWordsIo()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('forty-second', $words->words($carbon, 'Io'));
    }

    public function testWordsI()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('forty-two', $words->words($carbon, 'I'));
    }

    public function testWordsSo()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('eighth', $words->words($carbon, 'So'));
    }

    public function testWordsS()
    {
        $words = new DateAndNumberToWords();
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $this->assertEquals('eight', $words->words($carbon, 'S'));
    }
}
