<?php

namespace app\listeners\interview;

use app\events\interview\InterviewMoveEvent;
use app\services\NotifierInterface;

class InterviewMoveListener
{
    private $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(InterviewMoveEvent $event)
    {
        $this->notifier->notify(
            $event->interview->email,
            'interview/join',
            ['model' => $event->interview],
            'Your interview is moved'
        );
    }
} 