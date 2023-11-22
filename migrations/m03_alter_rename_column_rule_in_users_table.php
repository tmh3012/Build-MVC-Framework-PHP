<?php

//namespace app\migrations;

class m03_alter_rename_column_rule_in_users_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "ALTER TABLE users RENAME COLUMN rule TO role";
        $db->pdo->exec($sql);
    }
}