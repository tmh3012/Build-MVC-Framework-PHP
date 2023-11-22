<?php

namespace app\models;

use app\core\DbModel;

class Category extends DbModel
{
    public string $name ='';
    public string $slug ='';
    public string $description = '';
    public string|array $image ;

    public static function tableName(): string
    {
        return 'category';
    }

    public function attributes(): array
    {
        return [
            'parent_id',
            'name',
            'description',
            'slug',
            'image',
        ];
    }

    public function labels(): array
    {
        return [
            'name' => 'Category Name',
            'description' => 'Description',
            'slug' => 'Slug',
        ];
    }

    public function rules(): array
    {
        return [
            'image' => [
                self::RULE_REQUIRED,
            ],
            'name' => [self::RULE_REQUIRED],
            'slug' => [
                self::RULE_REQUIRED,
               [self::RULE_UNIQUE, 'class' => self::class]
            ],
        ];
    }
}