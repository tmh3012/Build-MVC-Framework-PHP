<?php

class m06_alter_add_image_column_to_category_table
{
        public function up()
        {
            $db = \app\core\Application::$app->db;
            $columns = $db->prepare("show columns from `category` like 'image'");
            $columns->execute();
            $hasColumn = $columns->rowCount();
            if(!$hasColumn) {
                $sql = "ALTER TABLE category ADD COLUMN image VARCHAR(512) NULL 
                        AFTER `slug`";
                $db->pdo->exec($sql);
            }
        }

        public function down() {

        }
}