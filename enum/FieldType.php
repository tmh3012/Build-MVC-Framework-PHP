<?php

namespace app\enum;

use app\core\enum;

class FieldType extends enum
{
    public const TYPE_TEXT = 'text';
    public const TYPE_FILE = 'file';
    public const TYPE_DATE = 'date';
    public const TYPE_MONTH = 'month';
    public const TYPE_RADIO = 'radio';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_CHECKBOX = 'checkbox';
}