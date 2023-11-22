<?php

namespace app\core;

class Validation
{
    public const RULE_REQUIRED = 'required';
    public const RULE_UNIQUE = 'unique';
    public const RULE_EMAIL = 'email';
    public const RULE_MATCH = 'match';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';

    public array $errors = [];
    public array $data;
    public array $rules;

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }


    public function validate(): bool|array
    {
        $validated = [];
        foreach ($this->rules as $attribute => $rules) {
            $value = $this->data[$attribute];
            foreach ($rules as $rule) {
                // get rule name
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }

                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute) ?? $attribute]);
                    }
                }
            }
            if (!$this->hasError($attribute)) {
               $validated[$attribute] = $value;
            }
        }
        return empty($this->errors) ? $validated : false;
//        return empty($this->errors) ? $validated : $this->errors;
    }

    private function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $errorMessage = $this->errorMessage()[$rule] ?? '';
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $errorMessage = str_replace("{{$key}}", strtolower($value), $errorMessage);
            }
        }
        $this->errors[$attribute][] = $errorMessage;
    }

    public function errorMessage(): array
    {
        return [
            self::RULE_REQUIRED => "This field is required",
            self::RULE_EMAIL => "This field must be valid email address",
            self::RULE_MIN => "Min length of field must be {min}",
            self::RULE_MAX => "Max length of field must be {max}",
            self::RULE_MATCH => "This field must be the same as {match}",
            self::RULE_UNIQUE => "This {field} already exists",
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0];
    }
}