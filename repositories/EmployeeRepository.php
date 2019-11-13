<?php

namespace app\repositories;

use app\models\Employee;
use app\repositories\exceptions\NotFoundException;

class EmployeeRepository
{
    /**
     * @param $id
     * @return Employee
     * @throws NotFoundException
     */
    public function find($id)
    {
        if (!$employee = Employee::findOne($id)) {
            throw new NotFoundException('Model not found.');
        }
        return $employee;
    }

    public function add(Employee $employee)
    {
        if (!$employee->getIsNewRecord()) {
            throw new \RuntimeException('Adding existing model.');
        }
        if (!$employee->insert(false)) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function save(Employee $employee)
    {
        if ($employee->getIsNewRecord()) {
            throw new \RuntimeException('Saving new model.');
        }
        if ($employee->update(false) === false) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function delete(Employee $employee)
    {
        if (!$employee->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }
} 