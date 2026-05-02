<?php

namespace Tests\Methods;

use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidLanguageException;
use PHPUnit\Framework\TestCase;

class SetLanguageTest extends TestCase
{
    public function test_set_language()
    {
        $words = new DateAndNumberToWords;
        $words->setLanguage('de');

        $result = $words->minute(42);
        $this->assertEquals('zwei­und­vierzig', $result);
        $this->assertNotEquals('zwei­und­vierzigste', $result);
        $this->assertIsString($result);
    }

    public function test_set_language_invalid()
    {
        $words = new DateAndNumberToWords;
        $this->expectException(InvalidLanguageException::class);
        $words->setLanguage('abc');
    }
}
