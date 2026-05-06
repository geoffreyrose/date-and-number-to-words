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

    public function test_words_escape_string()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Y of \Y');
        $this->assertEquals('two thousand twenty-three of Y', $result);
        $this->assertIsString($result);
    }

    public function test_words_escape_double_string()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Y of \Yo');
        $this->assertEquals('two thousand twenty-three of Yo', $result);
        $this->assertIsString($result);
    }

    public function test_words_escape_double_escape_string()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Y of \\\\\Yo');
        $this->assertEquals(<<<EOT
        two thousand twenty-three of \Yo
        EOT, $result);
        $this->assertIsString($result);
    }

    public function test_words_escape_string_end()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Y of \\\\\Yo\\');
        $this->assertEquals(<<<EOT
        two thousand twenty-three of \Yo\
        EOT, $result);
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

        $result = $words->words($carbon, '\hello');
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

    public function test_words_no_space_string()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'YY');
        $this->assertEquals('two thousand twenty-threetwo thousand twenty-three', $result);
        $this->assertIsString($result);
    }

    public function test_words_no_space_string_escape()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Y\Y');
        $this->assertEquals('two thousand twenty-threeY', $result);
        $this->assertIsString($result);
    }

    public function test_words_no_space_string_escape_mixed()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Y\Y D');
        $this->assertEquals('two thousand twenty-threeY one', $result);
        $this->assertIsString($result);
    }

    public function test_words_a_pm()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 14, 42, 8);

        $result = $words->words($carbon, 'A');
        $this->assertEquals('PM', $result);
        $this->assertIsString($result);
    }

    public function test_words_h_midnight_24()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 0, 42, 8);

        $result = $words->words($carbon, 'H');
        $this->assertEquals('zero', $result);
        $this->assertIsString($result);
    }

    public function test_words_h_max_24()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 23, 42, 8);

        $result = $words->words($carbon, 'H');
        $this->assertEquals('twenty-three', $result);
        $this->assertIsString($result);
    }

    public function test_words_h_midnight_12()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 0, 42, 8);

        $result = $words->words($carbon, 'h');
        $this->assertEquals('twelve', $result);
        $this->assertIsString($result);
    }

    public function test_words_h_noon_12()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 12, 0, 8);

        $result = $words->words($carbon, 'h');
        $this->assertEquals('twelve', $result);
        $this->assertIsString($result);
    }

    public function test_words_i_zero()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 0, 8);

        $result = $words->words($carbon, 'I');
        $this->assertEquals('zero', $result);
        $this->assertIsString($result);
    }

    public function test_words_s_zero()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 0);

        $result = $words->words($carbon, 'S');
        $this->assertEquals('zero', $result);
        $this->assertIsString($result);
    }

    public function test_words_i_max()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 59, 8);

        $result = $words->words($carbon, 'I');
        $this->assertEquals('fifty-nine', $result);
        $this->assertIsString($result);
    }

    public function test_words_s_max()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 59);

        $result = $words->words($carbon, 'S');
        $this->assertEquals('fifty-nine', $result);
        $this->assertIsString($result);
    }

    public function test_words_format_max_length()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, str_repeat('Y', 1024));
        $this->assertIsString($result);
    }

    public function test_words_format_max_length_plus_one()
    {
        $this->expectException(InvalidFormatException::class);
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $words->words($carbon, str_repeat('Y', 1025));
    }

    public function test_words_m_december()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 12, 1, 7, 42, 8);

        $result = $words->words($carbon, 'M');
        $this->assertEquals('December', $result);
        $this->assertIsString($result);
    }

    public function test_words_d_max()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 1, 31, 7, 42, 8);

        $result = $words->words($carbon, 'D');
        $this->assertEquals('thirty-one', $result);
        $this->assertIsString($result);
    }

    public function test_words_passthrough_o()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'o');
        $this->assertEquals('o', $result);
        $this->assertIsString($result);
    }

    public function test_words_all_tokens()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'h A I S D M Y');
        $this->assertEquals('seven AM forty-two eight one April two thousand twenty-three', $result);
        $this->assertIsString($result);
    }

    // Ordinal variants at boundary values

    public function test_words_ho_midnight_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 0, 42, 8);

        $result = $words->words($carbon, 'Ho');
        $this->assertEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_words_ho_max_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 23, 42, 8);

        $result = $words->words($carbon, 'Ho');
        $this->assertEquals('twenty-third', $result);
        $this->assertIsString($result);
    }

    public function test_words_lowercase_ho_midnight_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 0, 42, 8);

        $result = $words->words($carbon, 'ho');
        $this->assertEquals('twelfth', $result);
        $this->assertIsString($result);
    }

    public function test_words_io_zero_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 0, 8);

        $result = $words->words($carbon, 'Io');
        $this->assertEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_words_io_max_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 59, 8);

        $result = $words->words($carbon, 'Io');
        $this->assertEquals('fifty-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_words_so_zero_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 0);

        $result = $words->words($carbon, 'So');
        $this->assertEquals('zeroth', $result);
        $this->assertIsString($result);
    }

    public function test_words_so_max_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 59);

        $result = $words->words($carbon, 'So');
        $this->assertEquals('fifty-ninth', $result);
        $this->assertIsString($result);
    }

    public function test_words_do_max_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 1, 31, 7, 42, 8);

        $result = $words->words($carbon, 'Do');
        $this->assertEquals('thirty-first', $result);
        $this->assertIsString($result);
    }

    public function test_words_mo_december_ordinal()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(2023, 12, 1, 7, 42, 8);

        $result = $words->words($carbon, 'Mo');
        $this->assertEquals('twelfth', $result);
        $this->assertIsString($result);
    }

    // Language

    public function test_words_french_language()
    {
        $words = new DateAndNumberToWords;
        $words->setLanguage('fr');
        $carbon = Carbon::create(2023, 4, 1, 7, 42, 8);

        $result = $words->words($carbon, 'D M Y');
        $this->assertEquals('un avril deux mille vingt-trois', $result);
        $this->assertIsString($result);
    }
}
