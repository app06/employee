<?php

namespace app\events\employee;

use app\events\Event;
use app\events\LoggedEvent;
use app\models\Employee;

class EmployeeRecruitEvent extends Event implements LoggedEvent
{
    public $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getLogMessage()
    {
        return 'Employee ' . $this->employee->id . ' is recruit';
    }
}