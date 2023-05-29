<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    public string $type;
    public string $placeholder;

    public CONST TYPE_TEXT = 'text';

    /**
     * @param \app\core\Model $model
     * @param string $attribute
     * @param string $placeholder
     */
    public function __construct(Model $model, string $attribute, string $placeholder = '')
    {
        $this->model = $model;
        $this->type = self::TYPE_TEXT;
        $this->attribute = $attribute;
        $this->placeholder = $placeholder;
    }

    public function type($type): Field
    {
        $this->type = $type;
        return $this;
    }

    public function __toString()
    {
        return sprintf('
             <div class="form-group%s">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" class="form-control" value="%s" placeholder="%s">
                <span class="form-message">%s</span>
             </div>
        ', $this->model->hasError($this->attribute) ? ' invalid' : '',
            $this->model->getLabel($this->attribute) ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->placeholder,
            $this->model->hasError($this->attribute) ? $this->model->getFirstError($this->attribute) : '',
        );
    }
}