<?php

namespace App;

use App\Support\DateTimeConsts;

use DateTimeImmutable;
/**
 * Description of DueDateChecker
 */
class DueDateChecker
{
    use DateTimeConsts;

    /**
     * @desc - It is check the input date is in the work hour time, and not on the weekend
     * @param DateTimeImmutable $startDateClone
     * @return string|null
     */
    public function  preFiltering(DateTimeImmutable $startDateClone): ?string
    {
        $retVal = null;

        $dayIndexStart = (int) $startDateClone->format('w');

        $hourStart = $startDateClone->format('H:i');

        // if the start hour is not in the work hour range
        if ( ((int) $hourStart < self::START_WORKHOUR ) || ((int) $hourStart >= self::END_WORKHOUR) )
        {
            $retVal = 'All submited date times values are must be set between ' . self::START_WORKHOUR . 'AM to ' . self::END_WORKHOUR . 'PM.' . "\n";
        }// if the day is weekend, is not ok
        else if ($dayIndexStart < self::FIRST_WEEKDAY_INDEX || $dayIndexStart > self::LAST_WEEKDAY_INDEX)
        {
            $retVal = 'Only on work days' . "\n";
        }

        return $retVal;
    }

}