<?php

declare(strict_types=1);

namespace YDevs\CalendarHelper;

use Cake\Chronos\Date;

class CalendarHelper
{
    const FORMAT_YMD = 'Y-m-d';
    const FORMAT_YMDHIS = 'Y-m-d H:i:s';

    public static function getLastDayOfMonthDateByDate(\DateTimeImmutable $date): \DateTimeImmutable
    {
        $year = self::getYear($date);
        $month = self::getMonth($date);
        $lastDayOfMonth = self::getLastDayOfMonth($year, $month);

        return $date->setDate($year, $month, $lastDayOfMonth);
    }

    public static function getYear(\DateTimeImmutable $date): int
    {
        return self::toChronos($date)->year;
    }

    public static function toChronos(\DateTimeImmutable $date): Date
    {
        if ($date instanceof Date) {
            return $date;
        }

        return Date::createFromTimestamp($date->getTimestamp(), $date->getTimezone());
    }

    public static function getMonth(\DateTimeImmutable $date): int
    {
        return self::toChronos($date)->month;
    }

    public static function getLastDayOfMonth(int $year, int $month): int
    {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    public static function getFirstDayOfYear(int $year): Date
    {
        return Date::createFromFormat(self::FORMAT_YMD, "$year-01-01");
    }

    public static function getLastDayOfYear(int $year): Date
    {
        return Date::createFromFormat(self::FORMAT_YMD, "$year-12-31");
    }

    /**
     * @return int[]
     */
    public static function binDaysInPeriodByMonth(\DateTimeImmutable $start, \DateTimeImmutable $end): array
    {
        $current = self::toChronos($start);
        $end = self::toChronos($end);
        $bins = [];

        while ($current <= $end) {
            $month = $current->month;
            if (!array_key_exists($month, $bins)) {
                $bins[$month] = 0;
            }

            ++$bins[$month];
            $current = $current->addDay(1);
        }

        return $bins;
    }

    public static function getDaysInPeriod(\DateTimeImmutable $start, \DateTimeImmutable $end): int
    {
        return self::toChronos($start)->diffInDays(self::toChronos($end)) + 1;
    }

    public static function getDaysInPeriodCorrespondingToYear(\DateTimeImmutable $start, \DateTimeImmutable $end, $year): int
    {
        $current = self::toChronos($start);
        $end = self::toChronos($end);
        $count = 0;
        while ($current <= $end) {
            if ($current->year === $year) {
                ++$count;
            }
            $current = $current->addDay(1);
        }

        return $count;
    }

    public static function dayAfter(\DateTimeImmutable $date): Date
    {
        return self::toChronos($date)->addDay(1);
    }

    public static function getCurrentYear(): int
    {
        return intval(date('Y'));
    }

    public static function getMonthNamesEnglish(): array
    {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    }
}
