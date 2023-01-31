<?php

namespace DateToWords\Lang;

interface LanguageInterface
{
    public static function ordinalWords(): array;

    public static function months(): array;
}
