<?php

namespace app\models;

class RegisterModel extends Model
{
    public string $fullName = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function register()
    {
        echo "creat new user";
    }

    public function rules(): array
    {
        return [
            'fullName' => [
                self::RULE_REQUIRED,
            ],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min'=>'6'],
                [self::RULE_MAX, 'max'=>'12'],
            ],
            'passwordConfirm' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match'=>'password'],
            ],
        ];
    }
}