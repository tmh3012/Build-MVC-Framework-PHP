<?php

namespace app\core\form;

use app\core\Model;

class SelectField extends BaseField
{
    public array $options;

    public function __construct(Model $model, string $attribute, array $options)
    {
        $this->options = $options;
        parent::__construct($model, $attribute, '');
    }

    public function renderOptions(): string
    {
        $string = '';
        foreach ($this->options as $value => $label) {
            $string .= "<option value='".$value."'>$label</option>";
        }
        return $string;
    }

    public function renderField(): string
    {
        return sprintf('<select class="form-control" id="%s" name="%s">%s</select>',
            $this->attribute,
            $this->attribute,
            $this->renderOptions(),
        );
    }
}