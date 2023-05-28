<?php

namespace DueDate\Core;

use DueDate\Core\DateTimeHandler;

use DateTimeImmutable;
/**
 * Description of DueDateManger
 *
 * @author Csaba Barnabas Barcsa
 */
class DueDateManger
{
    const MAX_WORKHOUR = 8; // it's equal with one work day
    const START_WORKHOUR = 9; // the daily work hour start
    const END_WORKHOUR = 17; // the daily work hour end
    const FIRST_WORKDAY_INDEX = '1'; //monday
    const LAST_WORKDAY_INDEX = '5'; //friday

    /**
     * @desc - due date calculator
     * @param string $submitDate
     * @param string $turnTime - turnaround time in hours
     * @return \DateTimeImmutable|string
     */
    function calculateDueDate(string $submitDate, string $turnTime)
    {
        $retVal = null;
        ///if issue resolved then return the date time

        $startDateBase = (new DateTimeHandler($submitDate));
        $startDateBase->createDateTime();

//        $dateStart = new DateTimeImmutable($submitDate);
        $startDateClone = $startDateBase->cloneDateTime();

        $dayIndexStart = $startDateClone->format('w');

        $hourStart = $startDateClone->format('H:i');

        //---->/////////////////////másik osztályba
        // if the start hour is not in the work hour range
        if ( ( (int) $hourStart < self::START_WORKHOUR ) || ( (int) $hourStart >= self::END_WORKHOUR ) )
        {
            $retVal = 'All submit date values are set between ' . self::START_WORKHOUR . 'AM to ' . self::END_WORKHOUR . 'PM.' . "\n";
        }// if the day is weekend, is not ok
        else if ($dayIndexStart < self::FIRST_WORKDAY_INDEX || $dayIndexStart > self::LAST_WORKDAY_INDEX)
        {
            $retVal = 'Only on work days' . "\n";
        }
        //---->/////////////////////

        // if it in workhour and not weekend, then ...
        if ($retVal === null)
        {
            $leftHour = 0;
            $dayMany = (int) floor( (int) $turnTime / self::MAX_WORKHOUR);

            //////először is meg kell növelni az submit dátumot a turntimemmal, majd le csekkolni hogy úgy mennyi napba kerülne

//            var_dump($withTurnTime);


            if (($turnTime % self::MAX_WORKHOUR != 0) && $turnTime > self::MAX_WORKHOUR )
            {
                $leftHour =  $turnTime - ($dayMany * 8);
            }

            var_dump($dayMany);
            var_dump($leftHour);
            echo '-----<br>';
//            echo "\n";

            if ($dayMany === 0)
            {
//                echo '???????????';
                $newDate = $startDateClone->modify('+' . $turnTime . ' hour');

                $withTurnTime = $startDateBase->cloneDateTime()->modify('+' . $turnTime . 'hour');
                $possibleHour = $withTurnTime->format('H');


                if ((int)$possibleHour >= self::END_WORKHOUR)
                {
                    $remainingTime = $possibleHour - self::END_WORKHOUR;
                    $withTurnTime = $startDateBase->cloneDateTime()->modify('+1day 9:00+' . $remainingTime . 'hour');
                }

                return $withTurnTime->format('Y-m-d H:i');

//                var_dump($newDate);
                //lekérem az órát, és ha az óra valid, akkor hozzáadom, ha nem akkor növelem eggyel
            }
            else
            {
                $newDate = $startDateClone->modify('+' . $dayMany . ' day');
                $newDayIndex = $newDate->format('w');

        //        print_r($newDate);
        //        echo "\n";
                if ($newDayIndex === '6')
                {
                    $newDate = $newDate->modify('+2 day');
    //                var_dump($newDate);
    //                echo "\n";
                }
                else if ($newDayIndex === '0')
                {
                    $newDate = $newDate->modify('+1 day');
                }
        //        print_r($newDate);
        //        echo "\n";
            }


            $retVal = $newDate;
        }

        return $retVal;
    }

    /**/
    public function leftHour()
    {

    }

}