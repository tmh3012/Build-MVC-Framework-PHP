<?php

namespace app\core\form;


class TextareaField extends BaseField
{
    public function renderField(): string
    {
        return sprintf('<textarea name="%s" class="form-control" id="%s" placeholder="%s">%s</textarea>',
            $this->attribute,
            $this->attribute,
            $this->placeholder,
            $this->model->{$this->attribute},
        );
    }
}