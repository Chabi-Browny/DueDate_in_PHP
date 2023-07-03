<?php
/**
 * Constants only work in PHP >=8.2
 */

namespace App\Support;

trait DateTimeConsts
{
    const START_WORKHOUR = 9; // the daily work hour start
    const END_WORKHOUR = 17; // the daily work hour end

    const MAX_WORKHOUR = 8; // it's equal with one work day

    const FIRST_WEEKDAY_INDEX = 1; // monday
    const LAST_WEEKDAY_INDEX = 5; // friday
    const LAST_DAY_OF_THE_WEEK_INDEX = 6; // Saturday Sabbath
    const FIRST_DAY_OF_THE_WEEK_INDEX = 0; // sunday
}

