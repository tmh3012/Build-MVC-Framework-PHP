<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);
            $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
                VALUES (" . implode(",", $params) . ")");
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        } catch (\Throwable $e) {
            die($e->getMessage());
        }

    }

    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->prepare($sql);
    }

    public static function findOne($whereStatement)
    {
        $tableName = static::tableName();
        $attributes = array_keys($whereStatement);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($whereStatement as $columnName => $value) {
            $statement->bindValue(":$columnName", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}