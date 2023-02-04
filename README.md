<div style="text-align: center;"> 

[![Latest Stable Version](https://img.shields.io/packagist/v/geoffreyrose/date-and-number-to-words?style=flat-square)](https://packagist.org/packages/geoffreyrose/date-and-number-to-words)
[![Total Downloads](https://img.shields.io/packagist/dt/geoffreyrose/date-and-number-to-words?style=flat-square)](https://packagist.org/packages/geoffreyrose/date-and-number-to-words/stats)
[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/geoffreyrose/date-and-number-to-words/main.yml?branch=main&style=flat-square)](https://github.com/geoffreyrose/date-and-number-to-words/actions?query=branch%3Amain)
[![Codecov branch](https://img.shields.io/codecov/c/gh/geoffreyrose/date-and-number-to-words/main?style=flat-square)](https://app.codecov.io/gh/geoffreyrose/date-and-number-to-words/branch/main)
[![License](https://img.shields.io/github/license/geoffreyrose/date-and-number-to-words?style=flat-square)](https://github.com/geoffreyrose/date-and-number-to-words/blob/main/License)
</div>

# Date and Number To Words
An easy-to-use PHP package that turns dates and numbers into words. 

Numbers and each part of the date can additionally be turned into ordinal words. (first, second, third)



### Requirements
* [Carbon](http://carbon.nesbot.com/)
* PHP 8.0+

### Usage

#### With Composer
```
$ composer require geoffreyrose/date-and-number-to-words
```

```php
<?php
require 'vendor/autoload.php';

use DateAndNumberToWords\DateAndNumberToWords;
```

#### Without Composer

```php
<?php
require 'path/to/geoffreyrose/DateAndNumberToWords.php';

use DateAndNumberToWords\DateAndNumberToWords;
```


## Methods

You can pass a Carbon object, DateTime object or an integer for most methods

### Dates to Words

```php
public function words(Carbon|DateTime $date, string $format): string

$words = new DateAndNumberToWords();
$carbon = Carbon::create(2023, 4, 1);

$words->words($carbon, 'Do of M, Y');
// first of April, two thousand twenty-three
```

#### Formats

```text
Yo  :  Ordinal Year - year($year, true)
Y   :  Year - year($year)
Mo  :  Ordinal Month - month($month, true)
M   :  Month - month($month)
Do  :  Ordinal Day - day($day, true)
D   :  Day - day($day)
Ho  :  Ordinal Hour - hour($hour, true)
H   :  Hour - hour($hour)
Io  :  Ordinal Minute - minute($minute, true)
I   :  Minute - minute($minute)
So  :  Ordinal Second - second($second, true)
S   :  Second - second($second)
```

### Year to Words

```php
public function year(int|Carbon|DateTime $year, bool $ordinal = false): string

$words = new DateAndNumberToWords();
$carbon = Carbon::create(2023, 4, 1);

$dateTime = new DateTime();
$dateTime->setDate(2023, 4, 1);

$date = new DateTime();

$words->year(Carbon::now(), true);
// two thousand twenty-third

$words->year($dateTime);
// two thousand twenty-three

$words->year(2023, true);
// two thousand twenty-third

$words->year(2023);
// two thousand twenty-three

```

### Month to Words

```php
public function month(int|Carbon|DateTime $month, bool $ordinal = false): string

$words = new DateAndNumberToWords();

$words->month(4, true);
// fourth

$words->month(4);
// April
```

### Day to Words

```php
public function day(int|Carbon|DateTime $day, bool $ordinal = false): string

$words = new DateAndNumberToWords();

$words->day(7, true);
// seventh

$words->day(7);
// seven
```

### Hour to Words

```php
public function hour(int|Carbon|DateTime $hour, bool $ordinal = false): string

$words = new DateAndNumberToWords();

$words->hour(7, true);
// seventh

$words->hour(7);
// seven
```

### Minute to Words

```php
public function minute(int|Carbon|DateTime $minute, bool $ordinal = false): string

$words = new DateAndNumberToWords();

$words->minute(7, true);
// seventh

$words->minute(7);
// seven
```

### Second to Words

```php
public function second(int|Carbon|DateTime $second, bool $ordinal = false): string

$words = new DateAndNumberToWords();

$words->second(7, true);
// seventh

$words->second(7);
// seven
```

### Number to Words

Must be between 999999999999999999 and -999999999999999999

Only `int` will return an ordinal word. If `$ordinal` is true but `$number` is `float` a non-ordinal word will be returned.

```php
public function number(int|float $number, bool $ordinal = false): string

$words = new DateAndNumberToWords();

$words->number(7, true);
// seventh

$words->number(7);
// seven

$words->number(24.68);
// twenty-four point six eight

$words->number(24.68, true);
// twenty-four point six eight

$words->number(999999999999999999)
// nine hundred ninety-nine quadrillion nine hundred ninety-nine trillion nine hundred ninety-nine billion nine hundred ninety-nine million nine hundred ninety-nine thousand nine hundred ninety-nine

```




### Set Language

The default language is `en`

Every method other than `month` supports every language PHP does. PHP's native `NumberFormatter` is being used to translate numbers to words.

For months, translations are handled by Carbon, which has translations for 270+ locales.  
 

```php
public function setLanguage(string $language): void

$words = new DateAndNumberToWords();

$words->setLanguage('en');

```
