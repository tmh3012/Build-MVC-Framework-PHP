<?php

namespace app\core\form;

use app\core\Model;
use app\enum\FieldType;

class InputField extends BaseField
{
    public string $type;

    /**
     * @param \app\core\Model $model
     * @param string $attribute
     * @param string $placeholder
     */
    public function __construct(Model $model, string $attribute, string $placeholder)
    {
        $this->type = FieldType::TYPE_TEXT;
        parent::__construct($model, $attribute, $placeholder);
    }

    public function type($type): InputField
    {
        $this->type = $type;
        return $this;
    }

    public function typeFile(): InputField
    {
        $this->type = FieldType::TYPE_FILE;
        return $this;
    }

    public function typePassword(): InputField
    {
        $this->type = FieldType::TYPE_PASSWORD;
        return $this;
    }
    public function typeEmail(): InputField
    {
        $this->type = FieldType::TYPE_EMAIL;
        return $this;
    }

    public function renderField(): string
    {
        return sprintf('<input type="%s" name="%s" class="form-control" id="%s" value="%s" placeholder="%s" autocomplete="off">',
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->placeholder,
        );
    }
}