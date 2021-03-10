<?php


namespace App\Service;

use App\Entity\TimezoneInfo;
use Carbon\Carbon;

/**
 * Class TimeZoneInfoService
 * @package App\Service
 */
class TimeZoneInfoService
{
    const FEBRUARY = 'february';

    /**
     * @param TimezoneInfo $timezoneInfo
     * @return array|TimezoneInfo
     */
    public function getTimeZoneInfo(TimezoneInfo $timezoneInfo): array
    {
        return [
            'date' => $timezoneInfo->getDate(),
            'timezone' => $timezoneInfo->getTimezone(),
            'time_offset' => $this->calculateTimeOffset($timezoneInfo),
            'february_days' => $this->getFebruaryNumberOfDays($timezoneInfo),
            'month_name' => $this->getMonthName($timezoneInfo),
            'month_days' => $this->getMonthNumberOfDays($timezoneInfo)
        ];
    }

    private function calculateTimeOffset(TimezoneInfo $timezoneInfo): int
    {
        $timezone = Carbon::now($timezoneInfo->getTimezone());
        $utc = Carbon::now('UTC');

        return (int)$timezone->diffInMinutes($utc);
    }

    private function getFebruaryNumberOfDays(TimezoneInfo $timezoneInfo): int
    {
        return $this->getMonthNumberOfDays($timezoneInfo, self::FEBRUARY);
    }

    private function getMonthName(TimezoneInfo $timezoneInfo): string
    {
        $date = Carbon::create($timezoneInfo->getDate());

        return $date->monthName;
    }

    private function getMonthNumberOfDays(TimezoneInfo $timezoneInfo, $month = null): int
    {
        $date = Carbon::create($timezoneInfo->getDate());
        if (isset($month) && $month == self::FEBRUARY) {
            $date->setMonth(2);
        }

        return $date->daysInMonth;
    }
}