<?php

namespace Tests\Methods;

use Carbon\Carbon;
use DateAndNumberToWords\DateAndNumberToWords;
use DateTime;
use PHPUnit\Framework\TestCase;

class AmpmTest extends TestCase
{
    public function test_ampm_carbon_am()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 6, 42, 0);

        $result = $words->ampm($carbon);
        $this->assertEquals('AM', $result);
        $this->assertIsString($result);
    }

    public function test_ampm_carbon_pm()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 14, 42, 0);

        $result = $words->ampm($carbon);
        $this->assertEquals('PM', $result);
        $this->assertIsString($result);
    }

    public function test_ampm_date_time_am()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(6, 42, 0);

        $result = $words->ampm($dateTime);
        $this->assertEquals('AM', $result);
        $this->assertIsString($result);
    }

    public function test_ampm_date_time_pm()
    {
        $words = new DateAndNumberToWords;
        $dateTime = new DateTime;
        $dateTime->setDate(1999, 1, 24)->setTime(14, 42, 0);

        $result = $words->ampm($dateTime);
        $this->assertEquals('PM', $result);
        $this->assertIsString($result);
    }

    public function test_ampm_boundary_midnight()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 0, 0, 0);

        $result = $words->ampm($carbon);
        $this->assertEquals('AM', $result);
        $this->assertIsString($result);
    }

    public function test_ampm_boundary_noon()
    {
        $words = new DateAndNumberToWords;
        $carbon = Carbon::create(1999, 1, 24, 12, 0, 0);

        $result = $words->ampm($carbon);
        $this->assertEquals('PM', $result);
        $this->assertIsString($result);
    }
}
