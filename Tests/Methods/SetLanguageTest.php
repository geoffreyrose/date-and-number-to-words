<?php

use DateToWords\DateToWords;
use DateToWords\Exceptions\InvalidLanguageException;
use PHPUnit\Framework\TestCase;

class SetLanguageTest extends TestCase
{
    public function testSetLanguage()
    {
        $words = new DateToWords();
        $words->setLanguage('de');

        $this->assertEquals('zwei­und­vierzig', $words->minute(42));
        $this->assertNotEquals('zwei­und­vierzigste', $words->minute(42));
    }

    public function testSetLanguageInvalid()
    {
        $words = new DateToWords();
        $this->expectException(InvalidLanguageException::class);
        $words->setLanguage('abc');
    }
}
