<?php

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
    
//    echo 'startDate: ' . $date . "\n";
    
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
        
        var_dump($dayMany);
        var_dump($leftHour);
        echo "\n";
        
        if ($dayMany === 0)
        {
            echo '???????????';
            $newDate = $dateStart->modify('+' . $turnTime . ' hour');
            var_dump($newDate);
            //lekérem az órát, és ha az óra valid, akkor hozzáadom, ha nem akkor növelem eggyel
        }
        else
        {
            $newDate = $dateStart->modify('+' . $dayMany . ' day');
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


function leftHour()
{
    
}


print_r(calculateDueDate("2023-02-01 11:11", 7));
print_r(calculateDueDate("2023-02-01 08:59", 9));
print_r(calculateDueDate("2023-02-10 13:10", 28));
print_r(calculateDueDate("2023-02-09 14:12", 17));

//print_r(calculateDueDate("2023-02-10 17:10", 1231));
//print_r(calculateDueDate("2023-02-12 17:01", 12312));