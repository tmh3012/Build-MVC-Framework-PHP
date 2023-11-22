<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;
    public string $placeholder;

    /**
//     * @param Model $model
     * @param string $attribute
     * @param string $placeholder
     */

    public function __construct( string $attribute, string $placeholder = '')
    {
//        $this->model = $model;
        $this->attribute = $attribute;
        $this->placeholder = $placeholder;
    }

    abstract public function renderField(): string;

    public function __toString()
    {
        return sprintf('
             <div class="form-group%s">
                <label class="form-label">%s</label>
                %s
                <span class="form-message">%s</span>
             </div>
        ', $this->model->hasError($this->attribute) ? ' invalid' : '',
            $this->model->getLabel($this->attribute) ?? $this->attribute,
            $this->renderField(),
            $this->model->hasError($this->attribute) ? $this->model->getFirstError($this->attribute) : '',
        );
    }
}