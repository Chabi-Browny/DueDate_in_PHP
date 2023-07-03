<?php

use App\DueDateManger;

$dueDateManager = new DueDateManger();

/**
 * Test config runs
 */
return [
    $dueDateManager->manage('2023-02-01 10:11', '4'), // OK
    $dueDateManager->manage('2023-02-01 11:11', '7'), // OK
    $dueDateManager->manage('2023-02-01 16:11', '7'), // OK

    "\n" . '---------------------' . "\n",

    $dueDateManager->manage('2023-02-10 13:10', '29'), // 3day 5hour startDayIndex:5 targetDayIndex: 3// There is weekend day IN it
    $dueDateManager->manage('2023-02-09 14:12', '23'), // 2day 7hour startDayIndex:4 targetDayIndex: 1// There is weekend day IN it
    $dueDateManager->manage('2023-02-15 13:12', '100'), // 12day 4hour startDayIndex:3 targetDayIndex: 5// There is some weekend days IN it
    $dueDateManager->manage('2023-02-06 14:30', '32'), // 4day startDayIndex:1 targetDayIndex: 5// There is NO weekend day in it

    "\n" . '---------------------' . "\n",

    $dueDateManager->manage('2023-02-01 08:59', '9'),  // correctly FAILeD
    $dueDateManager->manage("2023-02-10 17:10", '1231'),  // correctly FAILeD
    $dueDateManager->manage("2023-02-12 16:01", '12312'),  // correctly FAILeD
];