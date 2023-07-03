<?php

namespace App;

use App\Handlers\DateTimeHandler;
use App\DueDateChecker;
use App\Support\DateTimeConsts;
use App\DueDateCalculator;
use App\DueDateModifier;

use DateTimeImmutable;
/**
 * Description of DueDateManger
 *
 * @author Csaba Barnabas Barcsa
 */
class DueDateManger
{
    use DateTimeConsts;

    protected $modifier;
    protected $calculator;

    public function __construct()
    {
        $this->modifier = new DueDateModifier();
        $this->calculator = new DueDateCalculator();
    }

    /**
     * @desc - manage the due date, calculate and correction
     * @param string $submitDate
     * @param string $turnTime - turnaround time in hours
     * @return \DateTimeImmutable|string
     */
    public function manage(string $submitDate, string $turnTime)
    {
        $startDateBase = (new DateTimeHandler($submitDate));
        $startDateBase->createDateTime();

        $startDateClone = $startDateBase->cloneDateTime();

        // if it in workhour and not weekend, then ...
        $retVal = (new DueDateChecker())->preFiltering($startDateClone);
        if ($retVal === null)
        {
            // the turntime in DAY quantity
            $neededDays = $this->calculator->getNeededDays((int) $turnTime);

            // if the turntime is lesser, than one day,
            // and it also means, that the work hour is lesser than 8
            if ($neededDays === 0)
            {
                $retVal = $this->modifier->setDateTimeWorkable($startDateClone)->modifyWithHourOnly($turnTime);
                $possibleHour = $retVal->format('H');

                // but it is going to the next day
                if ((int)$possibleHour >= self::END_WORKHOUR)
                {
                    $remainingTime = $possibleHour - self::END_WORKHOUR;

                    $retVal = $this->modifier->setDateTimeWorkable($startDateBase->cloneDateTime())->newDayPlusHour($remainingTime);
                }
            }
            else
            {
                $currentDateTime = $startDateClone;
                $currentHour = $currentDateTime->format('H');
                $currentDayIndex = (int) $startDateClone->format('w');

                // calulcate the left hour from the turnTime
                $remnantHour = $this->calculator->remnantHour((int) $turnTime, $neededDays);
                // there was a remainder for the remaining hour, and if it was greater than the end of the working time
                $remainderHour = $this->calculator->remainderHour((int) $currentHour, $remnantHour);

                $neededDays = $this->calculator->expandNeededDays($neededDays, $currentDayIndex);

                // modify the Datetime with recalculated needed days
                // here the $startDateClone will be modified under $currentDateTime
                $tagetDatetime = $this->modifier->setDateTimeWorkable($currentDateTime)->modifyWithDayOnly($neededDays);

                // if the remnant hour have remainder, and it is lesser than 8 hour
                if ($remainderHour > 0 && $remainderHour < self::MAX_WORKHOUR)
                {
                    $remainderModifier = $remnantHour - $remainderHour;

                    $retVal = $this->modifyIf($tagetDatetime, 'newDayPlusHour', $remainderModifier, $remainderHour);

                }// if only have remnant hour
                else if ($remnantHour > 0 && $remainderHour === 0)
                {
                    $retVal = $this->modifyIf($tagetDatetime, 'roundedToZeroMinute', $remnantHour, self::END_WORKHOUR);
                }
                else
                {
                  $retVal = $tagetDatetime;
                }
            }
        }
        return $retVal;
    }

    /**/
    protected function modifyIf(DateTimeImmutable $tagetDatetime, string $methodName, int $remnantModifier, string $hourModifier): DateTimeImmutable
    {
        $retVal = $this->modifier->setDateTimeWorkable($tagetDatetime)->modifyWithHourOnly($remnantModifier);

        if ((int) $retVal->format('H') === self::END_WORKHOUR)
        {
            $retVal = $this->modifier->setDateTimeWorkable($retVal)->$methodName($hourModifier);
        }

        return $retVal;
    }

}