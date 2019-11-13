<?php

namespace app\forms;

use yii\base\Model;

class InterviewJoinForm extends Model
{
    public $date;
    public $firstName;
    public $lastName;
    public $email;

    public function init()
    {
        $this->date = date('Y-m-d');
    }

    public function rules()
    {
        return [
            [['date', 'firstName', 'lastName'], 'required'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['email'], 'email'],
            [['firstName', 'lastName', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
        ];
    }
}