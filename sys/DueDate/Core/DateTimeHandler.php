<?php

namespace DueDate\Core;

use DateTimeImmutable;
/**
 * Description of DateTimeHandler
 *
 * @author csbb
 */
class DateTimeHandler
{
    protected $instance = null;
    protected $startDateTime;

    public function __construct(string $dateTime = 'now')
    {
        $this->startDateTime = $dateTime;
    }

    /**
     * @desc - Create the instance of a DateTimeImmutable
     * @return DateTimeHandler
     */
    public function createDateTime(): DateTimeHandler
    {
        $this->instance = new DateTimeImmutable($this->startDateTime);

        return $this;
    }

    /**
     * @desc - Clone current DateTimeImmutable instance
     * @return DateTimeImmutable
     */
    public function cloneDateTime(): DateTimeImmutable
    {
//        $currentInstance = $this->getInstance();
        return clone $this->instance;
    }

    /**
     * @desc - Get the actual DateTimeImmutable instance
     * @return DateTimeImmutable
     */
    public function getInstance(): DateTimeImmutable
    {
        return $this->instance;
    }

    
    public function getFormatedDateTime (string $formatterPhrase)
    {
        return $this->instance->modify($formatterPhrase);
    }

    public function clearInstance()
    {
        $this->instance = null;
    }
}
