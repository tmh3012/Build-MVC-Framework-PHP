<?php

namespace app\core\form;

use app\models\Model;

class Form
{
    public static function begin($id, $class, $action, $method)
    {
        echo sprintf('<form id="%s" class="%s" action="%s" method="%s">',
            $id,
            $class,
            $action,
            $method,
        );
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $label, $attribute, $placeholder = ''): Field
    {
        return new Field($model,$label, $attribute, $placeholder);
    }
}