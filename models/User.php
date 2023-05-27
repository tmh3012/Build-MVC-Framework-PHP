<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{


    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'name',
            'email',
            'password',
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [
                self::RULE_REQUIRED,
            ],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class],
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => '6'],
                [self::RULE_MAX, 'max' => '12'],
            ],
            'passwordConfirm' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password'],
            ],
        ];
    }
}