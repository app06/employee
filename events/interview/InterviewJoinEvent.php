<?php

namespace app\events\interview;

use app\events\Event;
use app\events\LoggedEvent;
use app\models\Interview;

class InterviewJoinEvent extends Event implements LoggedEvent
{
    public $interview;

    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    public function getLogMessage()
    {
        return $this->interview->last_name . ' ' . $this->interview->first_name . ' is joined to interview';
    }
}