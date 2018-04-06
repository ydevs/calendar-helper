<?php

declare(strict_types=1);

namespace YDevs\CalendarHelper\Tests;

use YDevs\CalendarHelper\CalendarHelper;

class CalendarHelperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testBinDaysInPeriodByMonth()
    {
        // Only one month
        $this->assertEquals(
            [
                1 => 16
            ],
            CalendarHelper::binDaysInPeriodByMonth(
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2000-01-10"),
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2000-01-25")
            )
        );

        // Two months
        $this->assertEquals(
            [
                1 => 22,
                2 => 12
            ],
            CalendarHelper::binDaysInPeriodByMonth(
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2000-01-10"),
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2000-02-12")
            )
        );

        // Three months, with leap year february
        $this->assertEquals(
            [
                1 => 22,
                2 => 29,
                3 => 9
            ],
            CalendarHelper::binDaysInPeriodByMonth(
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2000-01-10"),
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2000-03-9")
            )
        );
        // Two whole years, one leap one not
        $this->assertEquals(
            [
                1 => 31 * 2,
                2 => 28 + 29,
                3 => 31 * 2,
                4 => 30 * 2,
                5 => 31 * 2,
                6 => 30 * 2,
                7 => 31 * 2,
                8 => 31 * 2,
                9 => 30 * 2,
                10 => 31 * 2,
                11 => 30 * 2,
                12 => 31 * 2
            ],
            CalendarHelper::binDaysInPeriodByMonth(
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2000-01-01"),
                \DateTimeImmutable::createFromFormat(CalendarHelper::FORMAT_YMD, "2001-12-31")
            )
        );

    }
}