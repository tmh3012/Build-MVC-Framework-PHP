<?php

namespace app\core\form;

use app\core\Model;

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

    public function field(Model $model , $attribute, $placeholder = ''): Field
    {
        return new Field($model, $attribute, $placeholder);
    }
}