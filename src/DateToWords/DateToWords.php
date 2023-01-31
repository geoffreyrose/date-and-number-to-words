<?php

namespace DateToWords;

use Carbon\Carbon;
use DateTime;
use DateToWords\Exceptions\InvalidUnitException;
use NumberFormatter;

class DateToWords
{
    private string $language = 'en';

    private array $ordinalWords = [];

    protected array $months = [];

    protected NumberFormatter $numberFormatter;

    public function __construct()
    {
        $this->setTranslations();
    }

    private function setTranslations(): void
    {
        switch ($this->language) {
            case 'es':
                $this->numberFormatter = new NumberFormatter($this->language, NumberFormatter::SPELLOUT);
                $this->ordinalWords = Lang\Es::ordinalWords();
                $this->months = Lang\Es::months();
                break;
            default:
                $this->numberFormatter = new NumberFormatter($this->language, NumberFormatter::SPELLOUT);
                $this->ordinalWords = Lang\En::ordinalWords();
                $this->months = Lang\En::months();
                break;
        }
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
        $this->setTranslations();
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
