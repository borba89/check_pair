<?php

class m190129_113302_create_builging_types_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('building_types', array(
	        'id'=>'pk',
            'code'=>'varchar(255) DEFAULT NULL',
            'name'=>'varchar(255) DEFAULT NULL'
        ));

	    $sql = "
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'bricks', 'Кирпичный');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'panels', 'Панельный');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'combined', 'Комбинированный');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'monolyte', 'Монолитный');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'blocks', 'Блочный');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'limestone', 'Котельцовый');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'concrete', 'Бетон');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'cell_conrete', 'Ячеистый бетон');
        INSERT INTO `building_types`(`id`, `code`, `name`) VALUES (null , 'wood', 'Дерево');
        ";

	    Yii::app()->db->createCommand($sql)->execute();
	}

	public function safeDown()
	{
        echo "m190129_113302_create_builging_types_table does not support migration down.\n";
        return false;
	}
}