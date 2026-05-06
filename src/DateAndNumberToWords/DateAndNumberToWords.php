<?php

namespace DateAndNumberToWords;

use Carbon\Carbon;
use DateAndNumberToWords\Exceptions\InvalidFormatException;
use DateAndNumberToWords\Exceptions\InvalidLanguageException;
use DateAndNumberToWords\Exceptions\InvalidUnitException;
use DateTime;
use NumberFormatter;
use Throwable;

class DateAndNumberToWords
{
    private string $language = 'en';

    protected NumberFormatter $numberFormatter;

    protected NumberFormatter $ordinalNumberFormatter;

    /**
     * Initializes the formatter with the default language (English).
     */
    public function __construct()
    {
        $this->setLanguage($this->language);
    }

    /**
     * Sets the language/locale used for spelling out numbers and dates.
     *
     * @param  string  $language  A valid ICU locale string (e.g. 'en', 'fr', 'de').
     *
     * @throws InvalidLanguageException If the locale is not available in the PHP resource bundle.
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;

        $languages = resourcebundle_locales('');
        if ($languages === false || !in_array($this->language, $languages)) {
            throw new InvalidLanguageException('Invalid Language Set: Use one of your PHP bundle languages. You can see which languages are bundled with "resourcebundle_locales(\'\')" ');
        }

        $this->numberFormatter = new NumberFormatter($this->language, NumberFormatter::SPELLOUT);
        $this->ordinalNumberFormatter = new NumberFormatter($this->language, NumberFormatter::SPELLOUT);
        $this->ordinalNumberFormatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, '%spellout-ordinal');
    }

    /**
     * Converts a date to spelled-out words using a format string.
     *
     * Format tokens:
     *   Y/Yo  – year (cardinal/ordinal)
     *   M/Mo  – month (name/ordinal)
     *   D/Do  – day (cardinal/ordinal)
     *   H/Ho  – hour 24-hour (cardinal/ordinal)
     *   h/ho  – hour 12-hour (cardinal/ordinal)
     *   I/Io  – minute (cardinal/ordinal)
     *   S/So  – second (cardinal/ordinal)
     *   A     – AM / PM
     * Non-token characters (separators, spaces) are passed through unchanged.
     *
     * @param  Carbon|DateTime  $date  The date to convert.
     * @param  string  $format  Format string composed of the tokens above.
     * @return string The date expressed in words.
     *
     * @throws InvalidFormatException if the format string is invalid
     */
    public function words(Carbon|DateTime $date, string $format): string
    {

        if (strlen($format) === 0 || strlen($format) > 1024) {
            throw new InvalidFormatException('Format string must be at least 1 character long and not longer than 1024 characters');
        }

        $string = '';

        $oneFormats = ['Y', 'M', 'D', 'H', 'h', 'I', 'S', 'A'];
        $twoFormats = ['Yo', 'Mo', 'Do', 'Ho', 'ho', 'Io', 'So'];
        $i = 0;
        $len = strlen($format);
        while ($i < $len) {
            $two = substr($format, $i, 2); // peek at two chars
            $one = $format[$i];

            if ($one === '\\') {
                if ($i + 1 < $len) {
                    $string .= $format[$i + 1];
                } else {
                    $string .= $one;
                }
                $i += 2;

                continue;
            }

            if (in_array($two, $twoFormats) || in_array($one, $oneFormats)) {
                if (in_array($two, $twoFormats)) {
                    match ($two) {
                        'Yo' => $string .= $this->year($date, true),
                        'Mo' => $string .= $this->month($date, true),
                        'Do' => $string .= $this->day($date, true),
                        'Ho' => $string .= $this->hour($date, true),
                        'ho' => $string .= $this->hour($date, true, false),
                        'Io' => $string .= $this->minute($date, true),
                        'So' => $string .= $this->second($date, true),
                    };
                    $i++;
                } elseif (in_array($one, $oneFormats)) {
                    match ($one) {
                        'Y' => $string .= $this->year($date),
                        'M' => $string .= $this->month($date),
                        'D' => $string .= $this->day($date),
                        'H' => $string .= $this->hour($date),
                        'h' => $string .= $this->hour($date, twentyFour: false),
                        'I' => $string .= $this->minute($date),
                        'S' => $string .= $this->second($date),
                        'A' => $string .= $this->ampm($date),
                    };
                }
            } else {
                $string .= $one;
            }

            $i++;
        }

        return $string;
    }

    /**
     * Converts a year value to its spelled-out word form.
     *
     * @param  int|Carbon|DateTime  $year  An integer year, Carbon instance, or DateTime instance.
     * @param  bool  $ordinal  When true, returns the ordinal form (e.g. "two-thousand-twenty-fourth").
     * @return string The year expressed in words.
     *
     * @throws InvalidUnitException If the value is not a valid year input.
     */
    public function year(int|Carbon|DateTime $year, bool $ordinal = false): string
    {
        try {
            if (is_numeric($year) && $year <= 999999999999999999 && $year >= -999999999999999999) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format($year);
                } else {
                    $result = $this->numberFormatter->format($year);
                }

                return $result !== false ? $result : '';
            } elseif ($year instanceof Carbon) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $year->format('Y'));
                } else {
                    $result = $this->numberFormatter->format((int) $year->format('Y'));
                }

                return $result !== false ? $result : '';
            } elseif ($year instanceof DateTime) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $year->format('Y'));
                } else {
                    $result = $this->numberFormatter->format((int) $year->format('Y'));
                }

                return $result !== false ? $result : '';
            } else {
                throw new InvalidUnitException('Provide a valid year integer, Carbon object or PHP DateTime object');
            }
        } catch (Throwable $e) {
            throw new InvalidUnitException('Provide a valid year integer, Carbon object or PHP DateTime object');
        }
    }

    /**
     * Converts a month value to its localized name or ordinal word form.
     *
     * @param  int|Carbon|DateTime  $month  An integer month (1–12), Carbon instance, or DateTime instance.
     * @param  bool  $ordinal  When true, returns the ordinal form (e.g. "first"); otherwise returns the translated month name (e.g. "January").
     * @return string The month expressed in words.
     *
     * @throws InvalidUnitException If the value is not a valid month input.
     */
    public function month(int|Carbon|DateTime $month, bool $ordinal = false): string
    {
        try {
            if (is_numeric($month) && $month >= 1 && $month <= 12) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format($month);

                    return $result !== false ? $result : '';
                } else {
                    /** @var Carbon $date */
                    $date = Carbon::create(2023, $month, 2);
                    /** @var Carbon $localized */
                    $localized = $date->locale($this->language);

                    return $localized->getTranslatedMonthName();
                }
            } elseif ($month instanceof Carbon) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $month->format('n'));

                    return $result !== false ? $result : '';
                } else {
                    /** @var Carbon $localized */
                    $localized = $month->copy()->locale($this->language);

                    return $localized->getTranslatedMonthName();
                }
            } elseif ($month instanceof DateTime) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $month->format('n'));

                    return $result !== false ? $result : '';
                } else {
                    /** @var Carbon $date */
                    $date = Carbon::create($month);

                    /** @var Carbon $localized */
                    $localized = $date->locale($this->language);

                    return $localized->getTranslatedMonthName();
                }
            } else {
                throw new InvalidUnitException('Provide a valid month integer (1-12), Carbon object or PHP DateTime object');
            }
        } catch (Throwable $e) {
            throw new InvalidUnitException('Provide a valid month integer (1-12), Carbon object or PHP DateTime object');
        }
    }

    /**
     * Converts a day-of-month value to its spelled-out word form.
     *
     * @param  int|Carbon|DateTime  $day  An integer day (1–31), Carbon instance, or DateTime instance.
     * @param  bool  $ordinal  When true, returns the ordinal form (e.g. "twenty-first").
     * @return string The day expressed in words.
     *
     * @throws InvalidUnitException If the value is not a valid day input.
     */
    public function day(int|Carbon|DateTime $day, bool $ordinal = false): string
    {
        try {
            if (is_numeric($day) && $day >= 1 && $day <= 31) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format($day);
                } else {
                    $result = $this->numberFormatter->format($day);
                }

                return $result !== false ? $result : '';
            } elseif ($day instanceof Carbon) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $day->format('j'));
                } else {
                    $result = $this->numberFormatter->format((int) $day->format('j'));
                }

                return $result !== false ? $result : '';
            } elseif ($day instanceof DateTime) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $day->format('j'));
                } else {
                    $result = $this->numberFormatter->format((int) $day->format('j'));
                }

                return $result !== false ? $result : '';
            } else {
                throw new InvalidUnitException('Provide a valid day integer (1-31), Carbon object or PHP DateTime object');
            }
        } catch (Throwable $e) {
            throw new InvalidUnitException('Provide a valid day integer (1-31), Carbon object or PHP DateTime object');
        }
    }

    /**
     * Converts an hour value to its spelled-out word form.
     *
     * @param  int|Carbon|DateTime  $hour  An integer hour (0–23 for 24-hour; 1–12 for 12-hour), Carbon instance, or DateTime instance.
     * @param  bool  $ordinal  When true, returns the ordinal form (e.g. "third").
     * @param  bool  $twentyFour  When true (default), uses the 24-hour clock (0–23); when false, uses the 12-hour clock (1–12).
     * @return string The hour expressed in words.
     *
     * @throws InvalidUnitException If the value is not a valid hour input.
     */
    public function hour(int|Carbon|DateTime $hour, bool $ordinal = false, bool $twentyFour = true): string
    {
        $min = $twentyFour ? 0 : 1;
        $max = $twentyFour ? 23 : 12;
        $formatChar = $twentyFour ? 'G' : 'g';
        $range = $twentyFour ? '0-23' : '1-12';

        try {
            if (is_numeric($hour) && $hour >= $min && $hour <= $max) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format($hour);
                } else {
                    $result = $this->numberFormatter->format($hour);
                }

                return $result !== false ? $result : '';
            } elseif ($hour instanceof Carbon) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $hour->format($formatChar));
                } else {
                    $result = $this->numberFormatter->format((int) $hour->format($formatChar));
                }

                return $result !== false ? $result : '';
            } elseif ($hour instanceof DateTime) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $hour->format($formatChar));
                } else {
                    $result = $this->numberFormatter->format((int) $hour->format($formatChar));
                }

                return $result !== false ? $result : '';
            } else {
                throw new InvalidUnitException('Provide a valid hour integer (' . $range . '), Carbon object or PHP DateTime object');
            }
        } catch (Throwable $e) {
            throw new InvalidUnitException('Provide a valid hour integer (' . $range . '), Carbon object or PHP DateTime object');
        }
    }

    /**
     * Converts a minute value to its spelled-out word form.
     *
     * @param  int|Carbon|DateTime  $minute  An integer minute (0–59), Carbon instance, or DateTime instance.
     * @param  bool  $ordinal  When true, returns the ordinal form (e.g. "forty-fifth").
     * @return string The minute expressed in words.
     *
     * @throws InvalidUnitException If the value is not a valid minute input.
     */
    public function minute(int|Carbon|DateTime $minute, bool $ordinal = false): string
    {
        try {
            if (is_numeric($minute) && $minute >= 0 && $minute <= 59) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format($minute);
                } else {
                    $result = $this->numberFormatter->format($minute);
                }

                return $result !== false ? $result : '';
            } elseif ($minute instanceof Carbon) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $minute->format('i'));
                } else {
                    $result = $this->numberFormatter->format((int) $minute->format('i'));
                }

                return $result !== false ? $result : '';
            } elseif ($minute instanceof DateTime) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $minute->format('i'));
                } else {
                    $result = $this->numberFormatter->format((int) $minute->format('i'));
                }

                return $result !== false ? $result : '';
            } else {
                throw new InvalidUnitException('Provide a valid minute integer (0-59), Carbon object or PHP DateTime object');
            }
        } catch (Throwable $e) {
            throw new InvalidUnitException('Provide a valid minute integer (0-59), Carbon object or PHP DateTime object');
        }
    }

    /**
     * Converts a second value to its spelled-out word form.
     *
     * @param  int|Carbon|DateTime  $second  An integer second (0–59), Carbon instance, or DateTime instance.
     * @param  bool  $ordinal  When true, returns the ordinal form (e.g. "thirtieth").
     * @return string The second expressed in words.
     *
     * @throws InvalidUnitException If the value is not a valid second input.
     */
    public function second(int|Carbon|DateTime $second, bool $ordinal = false): string
    {
        try {
            if (is_numeric($second) && $second >= 0 && $second <= 59) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format($second);
                } else {
                    $result = $this->numberFormatter->format($second);
                }

                return $result !== false ? $result : '';
            } elseif ($second instanceof Carbon) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $second->format('s'));
                } else {
                    $result = $this->numberFormatter->format((int) $second->format('s'));
                }

                return $result !== false ? $result : '';
            } elseif ($second instanceof DateTime) {
                if ($ordinal) {
                    $result = $this->ordinalNumberFormatter->format((int) $second->format('s'));
                } else {
                    $result = $this->numberFormatter->format((int) $second->format('s'));
                }

                return $result !== false ? $result : '';
            } else {
                throw new InvalidUnitException('Provide a valid second integer (0-59), Carbon object or PHP DateTime object');
            }
        } catch (Throwable $e) {
            throw new InvalidUnitException('Provide a valid second integer (0-59), Carbon object or PHP DateTime object');
        }
    }

    /**
     * Returns AM or PM for a given date/time.
     *
     * @param  Carbon|DateTime  $ampm  Carbon instance or DateTime instance.
     * @return string 'AM' or 'PM'.
     *
     * @throws InvalidUnitException If the value is not a valid input.
     */
    public function ampm(Carbon|DateTime $ampm): string
    {
        return $ampm->format('A');
    }

    /**
     * Converts an integer or float to its spelled-out word form.
     *
     * Ordinal form is only applied when the value is an integer.
     *
     * @param  int|float  $number  The number to convert. Must be between -999999999999999999 and 999999999999999999.
     * @param  bool  $ordinal  When true and the number is an integer, returns the ordinal form (e.g. "forty-second").
     * @return string The number expressed in words.
     *
     * @throws InvalidUnitException If the number is out of the supported range.
     */
    public function number(int|float $number, bool $ordinal = false): string
    {
        try {
            if ($number <= 999999999999999999 && $number >= -999999999999999999) {
                if ($ordinal && is_int($number)) {
                    $result = $this->ordinalNumberFormatter->format($number);
                } else {
                    $result = $this->numberFormatter->format($number);
                }

                return $result !== false ? $result : '';
            } else {
                throw new InvalidUnitException('Provide a valid integer. Must be between 999999999999999999 and -999999999999999999');
            }
        } catch (Throwable $e) {
            throw new InvalidUnitException('Provide a valid integer. Must be between 999999999999999999 and -999999999999999999');
        }
    }
}
