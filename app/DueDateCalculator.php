<?php

namespace App;

use App\Support\DateTimeConsts;
/**
 * Description of DueDateCalculator
 */
class DueDateCalculator
{
    use DateTimeConsts;

    /**/
    public function remnantHour(int $turnTime, int $neededDays): int
    {
        $remnantHour = 0;

        if (($turnTime % self::MAX_WORKHOUR != 0) && $turnTime > self::MAX_WORKHOUR )
        {
            $remnantHour = (int) $turnTime - ($neededDays * self::MAX_WORKHOUR);
        }

        return $remnantHour;
    }

    /**/
    public function remainderHour( int $currentHour, int $remnantHour): int
    {
        $remainderHour = 0;

        if ( ($currentHour + $remnantHour) >= self::END_WORKHOUR)
        {
            $remainderHour = ($currentHour + $remnantHour) - self::END_WORKHOUR;
        }

        return $remainderHour;
    }

    /**/
    public function expandNeededDays(int $neededDays, int $currentDayIndex)
    {
        $moreDays = 0;

        for ($ind = 0; $ind < $neededDays; $ind++)
        {
            if ($currentDayIndex === self::LAST_DAY_OF_THE_WEEK_INDEX || $currentDayIndex === self::FIRST_DAY_OF_THE_WEEK_INDEX)
            {
                $currentDayIndex = 1;
                $moreDays += 2;
            }
            else
            {
                $currentDayIndex++;
            }
            // check next day index
            if ($currentDayIndex === self::LAST_DAY_OF_THE_WEEK_INDEX || $currentDayIndex === self::FIRST_DAY_OF_THE_WEEK_INDEX)
            {
                $currentDayIndex = 1;
                $moreDays += 2;
            }
        }

        return $neededDays += $moreDays;
    }

    /**/
    public function getNeededDays(int $turnTime): int
    {
        return (int) floor( (int) $turnTime / self::MAX_WORKHOUR);
    }

}
