<?php

namespace DateToWords;

use Carbon\Carbon;
use DateTime;
use DateToWords\Exceptions\InvalidUnitException;
use NumberFormatter;

class DateToWords
{
    private string $language = 'en-us';

    private array $ordinalWords = [
        1 => 'first',
        2 => 'second',
        3 => 'third',
        4 => 'fourth',
        5 => 'fifth',
        6 => 'sixth',
        7 => 'seventh',
        8 => 'eighth',
        9 => 'ninth',
        10 => 'tenth',
        11 => 'eleventh',
        12 => 'twelfth',
        13 => 'thirteenth',
        14 => 'fourteenth',
        15 => 'fifteenth',
        16 => 'sixteenth',
        17 => 'seventeenth',
        18 => 'eighteenth',
        19 => 'nineteenth',
        20 => 'twentieth',
        21 => 'twenty-first',
        22 => 'twenty-second',
        23 => 'twenty-third',
        24 => 'twenty-fourth',
        25 => 'twenty-fifth',
        26 => 'twenty-sixth',
        27 => 'twenty-seventh',
        28 => 'twenty-eighth',
        29 => 'twenty-ninth',
        30 => 'thirtieth',
        31 => 'thirty-first',
        32 => 'thirty-second',
        33 => 'thirty-third',
        34 => 'thirty-fourth',
        35 => 'thirty-fifth',
        36 => 'thirty-sixth',
        37 => 'thirty-seventh',
        38 => 'thirty-eighth',
        39 => 'thirty-ninth',
        40 => 'fortieth',
        41 => 'forty-first',
        42 => 'forty-second',
        43 => 'forty-third',
        44 => 'forty-fourth',
        45 => 'forty-fifth',
        46 => 'forty-sixth',
        47 => 'forty-seventh',
        48 => 'forty-eighth',
        49 => 'forty-ninth',
        50 => 'fiftieth',
        51 => 'fifty-first',
        52 => 'fifty-second',
        53 => 'fifty-third',
        54 => 'fifty-fourth',
        55 => 'fifty-fifth',
        56 => 'fifty-sixth',
        57 => 'fifty-seventh',
        58 => 'fifty-eighth',
        59 => 'fifty-ninth',
        60 => 'sixtieth',
    ];

    protected array $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    protected NumberFormatter $numberFormatter;

    public function __construct()
    {
        $this->numberFormatter = new NumberFormatter($this->language, NumberFormatter::SPELLOUT);
    }

    public function words(Carbon|DateTime $date, string $format, bool $ordinal = false): String
    {
        return $date;
    }

    public function year(int|Carbon|DateTime $year, bool $ordinal = false): String
    {
        try {
            if (is_numeric($year)) {
                return $this->numberFormatter->format($year);
            } elseif ($year instanceof Carbon) {
                return $year->format('Y');
            } elseif ($year instanceof DateTime) {
                return $year->format('Y');
            } else {
                throw new InvalidUnitException('Provide a valid year integer, Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }

    public function month(int|Carbon|DateTime $month, bool $ordinal = false): String
    {
        try {
            if (is_numeric($month) && $month >= 1 && $month <= 12) {
                if ($ordinal) {
                    return $this->ordinalWords[$month];
                } else {
                    return $this->months[$month];
                }
            } elseif ($month instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalWords[$month->month];
                } else {
                    return $month->format('F');
                }
            } elseif ($month instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalWords[$month->format('n')];
                } else {
                    return $month->format('F');
                }
            } else {
                throw new InvalidUnitException('Provide a valid month integer (1-12), Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }

    public function day(int|Carbon|DateTime $day, bool $ordinal = false): String
    {
        try {
            if (is_numeric($day) && $day >= 1 && $day <= 31) {
                if ($ordinal) {
                    return $this->ordinalWords[$day];
                } else {
                    return $this->numberFormatter->format($day);
                }
            } elseif ($day instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalWords[$day->format('j')];
                } else {
                    return $this->numberFormatter->format($day->format('j'));
                }
            } elseif ($day instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalWords[$day->format('j')];
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

    public function hour(int|Carbon|DateTime $hour, bool $ordinal = false): String
    {
        try {
            if (is_numeric($hour) && $hour >= 0 && $hour <= 23) {
                if ($ordinal) {
                    return $this->ordinalWords[$hour];
                } else {
                    return $this->numberFormatter->format($hour);
                }
            } elseif ($hour instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalWords[$hour->format('g')];
                } else {
                    return $this->numberFormatter->format($hour->format('g'));
                }
            } elseif ($hour instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalWords[$hour->format('g')];
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

    public function minute(int|Carbon|DateTime $minute, bool $ordinal = false): String
    {
        try {
            if (is_numeric($minute) && $minute >= 0 && $minute <= 59) {
                if ($ordinal) {
                    return $this->ordinalWords[$minute];
                } else {
                    return $this->numberFormatter->format($minute);
                }
            } elseif ($minute instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalWords[$minute->format('i')];
                } else {
                    return $this->numberFormatter->format($minute->format('i'));
                }
            } elseif ($minute instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalWords[$minute->format('i')];
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

    public function second(int|Carbon|DateTime $second, bool $ordinal = false): String
    {
        try {
            if (is_numeric($second) && $second >= 0 && $second <= 59) {
                if ($ordinal) {
                    return $this->ordinalWords[$second];
                } else {
                    return $this->numberFormatter->format($second);
                }
            } elseif ($second instanceof Carbon) {
                if ($ordinal) {
                    return $this->ordinalWords[$second->format('j')];
                } else {
                    return $this->numberFormatter->format($second->format('j'));
                }
            } elseif ($second instanceof DateTime) {
                if ($ordinal) {
                    return $this->ordinalWords[$second->format('j')];
                } else {
                    return $this->numberFormatter->format($second->format('j'));
                }
            } else {
                throw new InvalidUnitException('Provide a valid second integer (0-59), Carbon object or PHP DateTime object');
            }
        } catch (InvalidUnitException $e) {
            return $e->getMessage();
        }
    }
}
