<?php

class m05_create_table_variation
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = " CREATE TABLE variation (
              `id` int auto_increment PRIMARY KEY ,
              `category_id` int NULL,
              `name` varchar(255) NOT NULL,
               `created_at` timestamp default current_timestamp,
              `updated_at` timestamp,
              `deleted_at`  timestamp,
              foreign key(category_id) references category(id)
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE variation;";
        $db->pdo->exec($sql);
    }
}