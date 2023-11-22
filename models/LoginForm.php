<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;
use app\models\User;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => '6'],
                [self::RULE_MAX, 'max' => '12'],
            ],
        ];
    }

    public function labels(): array
    {
       return [
         'email' => 'Email',
         'password' => 'Password',
       ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);

        if (!$user) {
            $this->addError('email', 'Email not found');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password incorrect');
            return false;
        }
        return Application::$app->login($user);
    }

}