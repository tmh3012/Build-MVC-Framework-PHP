<?php

//namespace app\migrations;

class m01_initial
{

    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = " CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            rule INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE users;";
        $db->pdo->exec($sql);
    }

}