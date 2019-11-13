<?php

namespace app\forms;

use app\models\Interview;
use yii\base\Model;

class InterviewEditForm extends Model
{
    public $firstName;
    public $lastName;
    public $email;

    private $interview;

    public function __construct(Interview $interview, $config = [])
    {
        $this->interview = $interview;
        $this->lastName = $interview->last_name;
        $this->firstName = $interview->first_name;
        $this->email = $interview->email;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'required'],
            [['email'], 'email'],
            [['firstName', 'lastName', 'email'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
        ];
    }
}