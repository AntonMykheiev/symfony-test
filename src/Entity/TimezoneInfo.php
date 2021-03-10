<?php

namespace App\Entity;

/**
 * Class TimezoneInfo
 * @package App\Entity
 */
class TimezoneInfo
{
    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $timezone;

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }
}