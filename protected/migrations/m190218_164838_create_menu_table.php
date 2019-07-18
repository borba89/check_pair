<?php

class m190218_164838_create_menu_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('menu', array(
	        'id'=>'pk',
            'name'=>'varchar(100) NOT NULL',
            'enabled'=>'tinyint(1) NOT NULL DEFAULT 1',
            'vertical'=>'tinyint(1) NOT NULL DEFAULT 0 COMMENT "makes menu vertical"',
            'rtl'=>'tinyint(1) NOT NULL DEFAULT 0',
            'upward'=>'tinyint(1) NOT NULL DEFAULT 0',
            'theme'=>'varchar(100) NOT NULL DEFAULT "default"',
            'description'=>'text'
        ), 'ENGINE InnoDB');

	    $this->createTable('menu_item', array(
	        'id'=>'pk',
            'menu_id'=>'int(11) DEFAULT NULL',
            'parent_id'=>'int(11) NOT NULL DEFAULT 0',
            'depth'=>'int(11) NOT NULL DEFAULT 1',
            'lft'=>'int(11) NOT NULL',
            'rgt'=>'int(11) NOT NULL',
            'name_en'=>'varchar(128) NOT NULL',
            'name_ru'=>'varchar(128) NOT NULL',
            'name_ro'=>'varchar(128) NOT NULL',
            'enabled'=>'tinyint(1) NOT NULL DEFAULT 1',
            'target'=>'varchar(10) DEFAULT NULL',
            'description'=>'text',
            'link_en'=>'text',
            'link_ru'=>'text',
            'link_ro'=>'text',
            'type'=>'varchar(50) NOT NULL DEFAULT "url"',
            'role'=>'varchar(255) DEFAULT "all"'
        ), 'ENGINE InnoDB');

	    $this->createIndex('idx_menu_item_menu_id', 'menu_item', 'menu_id');
	    $this->addForeignKey('menu_item_ibfk_1', 'menu_item', 'menu_id', 'menu', 'id', 'CASCADE');
	}

	public function safeDown()
	{
        echo "m190218_164838_create_menu_table does not support migration down.\n";
        return false;
	}
}