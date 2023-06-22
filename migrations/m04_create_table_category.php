<?php
class m04_create_table_category {
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = " CREATE TABLE category (
              `id` int auto_increment primary key,
              `parent_id` int null,
              `name` varchar(255) NOT NULL,
              `description` text null,
              `slug` varchar(255) UNIQUE,
              `status` bool DEFAULT 1,
              `created_at` timestamp default current_timestamp,
              `updated_at` timestamp,
              `deleted_at`  timestamp,
              foreign key (parent_id) references category(id)
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE category;";
        $db->pdo->exec($sql);
    }
}