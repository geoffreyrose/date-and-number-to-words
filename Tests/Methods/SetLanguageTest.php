<?php

namespace Tests\Methods;

use DateAndNumberToWords\DateAndNumberToWords;
use DateAndNumberToWords\Exceptions\InvalidLanguageException;
use PHPUnit\Framework\TestCase;

class SetLanguageTest extends TestCase
{
    public function testSetLanguage()
    {
        $words = new DateAndNumberToWords();
        $words->setLanguage('de');

        $this->assertEquals('zwei­und­vierzig', $words->minute(42));
        $this->assertNotEquals('zwei­und­vierzigste', $words->minute(42));
    }

    public function testSetLanguageInvalid()
    {
        $words = new DateAndNumberToWords();
        $this->expectException(InvalidLanguageException::class);
        $words->setLanguage('abc');
    }
}
