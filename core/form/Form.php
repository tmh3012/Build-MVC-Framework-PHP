<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($id, $class, $action, $method, $enctype = null)
    {
        echo sprintf('<form id="%s" class="%s" action="%s" method="%s" %s>',
            $id,
            $class,
            $action,
            $method,
            $enctype ? 'enctype="'.$enctype.'"' : '',
        );
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function input($attribute, $placeholder = ''): InputField
    {
        return new InputField($attribute, $placeholder);
    }

    public function textarea(Model $model , $attribute, $placeholder = ''): TextareaField
    {
        return new TextareaField($model , $attribute, $placeholder);
    }

    public function select(Model $model , $attribute, $options): SelectField
    {
        return new SelectField($model , $attribute, $options);
    }

    public function button($type, $id, $class, $text, $disabled = false)
    {
        echo sprintf('<div class="form-group "><button type="%s" %s class="btn %s" %s>%s</button></div>',
            $type,
            $id ? 'id="'.$id.'"' : '',
            $class,
            $disabled ? 'disabled' : '',
            $text,
        );
    }
}