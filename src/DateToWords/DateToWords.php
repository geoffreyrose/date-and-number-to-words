<?php

namespace DateToWords;

use Carbon\Carbon;
use DateTime;
use DateToWords\Exceptions\InvalidLanguageException;
use DateToWords\Exceptions\InvalidUnitException;
use NumberFormatter;

class DateToWords
{
    private string $language = 'en';

    protected NumberFormatter $numberFormatter;

    protected NumberFormatter $ordinalNumberFormatter;

    public function __construct()
    {
        $this->setLanguage($this->language);
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;

        $languages = resourcebundle_locales('');
        if (!in_array($this->language, $languages)) {
            throw new InvalidLanguageException('Invalid Language Set: Use one of your PHP bundle languages. You can see which languages are bundled with "resourcebundle_locales(\'\')" ');
        }

        $this->numberFormatter = new NumberFormatter($this->language, NumberFormatter::SPELLOUT);
        $this->ordinalNumberFormatter = new NumberFormatter($this->language, NumberFormatter::SPELLOUT);
        $this->ordinalNumberFormatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, '%spellout-ordinal');
    }

    public function words(Carbon|DateTime $date, string $format): string
    {
        $formatArray = preg_split('/([\W])/', $format, -1, PREG_SPLIT_DELIM_CAPTURE);
        $string = '';

        foreach ($formatArray as $part) {
            match ($part) {
                'Yo' => $string .= $this->year($date, true),
                'Y' => $string .= $this->year($date),
                'Mo' => $string .= $this->month($date, true),
                'M' => $string .= $this->month($date),
                'Do' => $string .= $this->day($date, true),
                'D' => $string .= $this->day($date),
                'Ho' => $string .= $this->hour($date, true),
                'H' => $string .= $this->hour($date),
                'Io' => $string .= $this->minute($date, true),
                'I' => $string .= $this->minute($date),
                'So' => $string .= $this->second($date, true),
                'S' => $string .= $this->second($date),
                default => $string .= $part,
            };
        }

        return $string;
    }

    public function year(int|Carbon|DateTime $year, bool $ordinal = false): string
    {
        try {
            if (is_numeric($year) && $year <= 999999999999999999) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($year);
                } else {
                    return $this->numberFormatter->format($year);
                }
            } elseif ($year instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($year->format('Y'));
                } else {
                    return $this->numberFormatter->format($year->format('Y'));
                }
            } elseif ($year instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($year->format('Y'));
                } else {
                    return $this->numberFormatter->format($year->format('Y'));
                }
            } else {
                throw new InvalidUnitException('Provide a valid year integer, Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }

    public function month(int|Carbon|DateTime $month, bool $ordinal = false): string
    {
        try {
            if (is_numeric($month) && $month >= 1 && $month <= 12) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($month);
                } else {
                    $date = Carbon::create(2023, $month, 2);

                    return $date->locale($this->language)->getTranslatedMonthName();
                }
            } elseif ($month instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($month->format('n'));
                } else {
                    return $month->copy()->locale($this->language)->getTranslatedMonthName();
                }
            } elseif ($month instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($month->format('n'));
                } else {
                    $date = Carbon::create($month);

                    return $date->locale($this->language)->getTranslatedMonthName();
                }
            } else {
                throw new InvalidUnitException('Provide a valid month integer (1-12), Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }

    public function day(int|Carbon|DateTime $day, bool $ordinal = false): string
    {
        try {
            if (is_numeric($day) && $day >= 1 && $day <= 31) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($day);
                } else {
                    return $this->numberFormatter->format($day);
                }
            } elseif ($day instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($day->format('j'));
                } else {
                    return $this->numberFormatter->format($day->format('j'));
                }
            } elseif ($day instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($day->format('j'));
                } else {
                    return $this->numberFormatter->format($day->format('j'));
                }
            } else {
                throw new InvalidUnitException('Provide a valid day integer (1-31), Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }

    public function hour(int|Carbon|DateTime $hour, bool $ordinal = false): string
    {
        try {
            if (is_numeric($hour) && $hour >= 0 && $hour <= 23) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($hour);
                } else {
                    return $this->numberFormatter->format($hour);
                }
            } elseif ($hour instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($hour->format('g'));
                } else {
                    return $this->numberFormatter->format($hour->format('g'));
                }
            } elseif ($hour instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($hour->format('g'));
                } else {
                    return $this->numberFormatter->format($hour->format('g'));
                }
            } else {
                throw new InvalidUnitException('Provide a valid hour integer (0-23), Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }

    public function minute(int|Carbon|DateTime $minute, bool $ordinal = false): string
    {
        try {
            if (is_numeric($minute) && $minute >= 0 && $minute <= 59) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($minute);
                } else {
                    return $this->numberFormatter->format($minute);
                }
            } elseif ($minute instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($minute->format('i'));
                } else {
                    return $this->numberFormatter->format($minute->format('i'));
                }
            } elseif ($minute instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($minute->format('i'));
                } else {
                    return $this->numberFormatter->format($minute->format('i'));
                }
            } else {
                throw new InvalidUnitException('Provide a valid minute integer (0-59), Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }

    public function second(int|Carbon|DateTime $second, bool $ordinal = false): string
    {
        try {
            if (is_numeric($second) && $second >= 0 && $second <= 59) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($second);
                } else {
                    return $this->numberFormatter->format($second);
                }
            } elseif ($second instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($second->format('s'));
                } else {
                    return $this->numberFormatter->format($second->format('s'));
                }
            } elseif ($second instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalNumberFormatter->format($second->format('s'));
                } else {
                    return $this->numberFormatter->format($second->format('s'));
                }
            } else {
                throw new InvalidUnitException('Provide a valid second integer (0-59), Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }
}
