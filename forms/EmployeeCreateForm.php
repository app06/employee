<?php

namespace app\forms;

use app\models\Interview;
use yii\base\Model;

class EmployeeCreateForm extends Model
{
    public $firstName;
    public $lastName;
    public $address;
    public $email;
    public $orderDate;
    public $contractDate;
    public $recruitDate;

    private $interview;

    /**
     * @param Interview $interview
     * @param array $config
     */
    public function __construct(Interview $interview = null, $config = [])
    {
        $this->interview = $interview;
        parent::__construct($config);
    }

    public function init()
    {
        if ($this->interview) {
            $this->lastName = $this->interview->last_name;
            $this->firstName = $this->interview->first_name;
            $this->email = $this->interview->email;
        }
        $this->orderDate = date('Y-m-d');
        $this->contractDate = date('Y-m-d');
        $this->recruitDate = date('Y-m-d');
    }

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'address'], 'required'],
            [['email'], 'email'],
            [['firstName', 'lastName', 'email', 'address'], 'string', 'max' => 255],
            [['orderDate', 'contractDate', 'recruitDate'], 'required'],
            [['orderDate', 'contractDate', 'recruitDate'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'orderDate' => 'Order Date',
            'contractDate' => 'Contract Date',
            'recruitDate' => 'Recruit Date',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'address' => 'Address',
            'email' => 'Email',
        ];
    }
}