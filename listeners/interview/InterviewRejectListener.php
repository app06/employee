<?php

namespace app\listeners\interview;

use app\events\interview\InterviewRejectEvent;
use app\services\NotifierInterface;

class InterviewRejectListener
{
    private $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(InterviewRejectEvent $event)
    {
        $this->notifier->notify(
            $event->interview->email,
            'interview/join',
            ['model' => $event->interview],
            'Your interview is rejected'
        );
    }
} 