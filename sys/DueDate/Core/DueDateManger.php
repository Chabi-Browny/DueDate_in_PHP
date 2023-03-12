<?php

namespace DueDate\Core;

use DateTimeImmutable;
/**
 * Description of DueDateManger
 *
 * @author Csaba Barnabas Barcsa
 */
class DueDateManger
{
    
    
    /**
     * @desc - due date calculator
     * @param string $date
     * @param string $turnTime - turnaround time in hours
     * @return \DateTimeImmutable|string
     */
    function calculateDueDate(string $date, string $turnTime)
    {
        $retVal = null;
        ///if isseu resolved then return the date time
        $workStart = '09'; // the daily work hour start
        $workEnd = '17'; // the daily work hour end
        $workHourMax = '8'; // it's equal with one work day
        $workDayStart = '2'; //monday
        $workDayEnd = '6';   //friday

        $dateStart = new DateTimeImmutable($date);

        $dayIndexStart = $dateStart->format('w');

        $hourStart = $dateStart->format('H:i');

        if ($dayIndexStart < '1' || $dayIndexStart > '5')
        {
            $retVal = 'Only on work days' . "\n";
        }
        else if (($hourStart < '9' && $hourStart >= '17'))
        {
            $retVal = 'All submit date values are set between 9AM to 5PM.' . "\n";
        }

        if ($retVal === null)
        {
            $leftHour = 0;
            $dayMany = (int) floor($turnTime / $workHourMax);

            if (($turnTime % $workHourMax != 0) && $turnTime > $workHourMax )
            {
                $leftHour =  $turnTime - ($dayMany * 8);
            }

            if ($dayMany === 0)
            {
                $newDate = $dateStart->modify('+' . $turnTime . ' hour');
                //lekérem az órát, és ha az óra valid, akkor hozzáadom, ha nem akkor növelem eggyel.....
            }
            else
            {
                $newDate = $dateStart->modify('+' . $dayMany . ' day');
                $newDayIndex = $newDate->format('w');

                if ($newDayIndex === '6') 
                {
                    $newDate = $newDate->modify('+2 day');
                }
                else if ($newDayIndex === '0')
                {
                    $newDate = $newDate->modify('+1 day');
                }  
            }


            $retVal = $newDate;        
        }

        return $retVal;
    }


    function leftHour()
    {

    }
}
