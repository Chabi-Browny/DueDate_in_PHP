<?php

namespace App;

use App\Support\DateTimeConsts;

use DateTimeImmutable;
/**
 * Description of DueDateModifiers
 */
class DueDateModifier
{
    use DateTimeConsts;

    protected $currentDateTime;

    public function setDateTimeWorkable(DateTimeImmutable $dateTimeObj): self
    {
        $this->currentDateTime = $dateTimeObj;
        return $this;
    }

    public function modifyWithHourOnly($hour)
    {
        return $this->modifyWithOne($hour, 'hour');
    }

    public function modifyWithDayOnly($day)
    {
        return $this->modifyWithOne($day, 'day');
    }

    public function roundedToZeroMinute(string $hour)
    {
        return $this->currentDateTime->modify( $hour . ':00' );
    }

    public function newDayPlusHour($hour)
    {
        return $this->currentDateTime->modify('+1day ' . self::START_WORKHOUR . ':00+' . $hour . 'hour');
    }

    /**/
    protected function modifyWithOne($modifyWith, $modifierStr)
    {
        return $this->currentDateTime->modify('+' . $modifyWith . $modifierStr);
    }

}
