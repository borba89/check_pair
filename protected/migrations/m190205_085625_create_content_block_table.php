<?php

class m190205_085625_create_content_block_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('content_block', array(
            'id'=>'pk',
            'category'=>'varchar(255) NOT NULL',
            'name' => 'varchar(250) NOT NULL',
            'description' => 'varchar(255) DEFAULT NULL',
            'code'=> 'varchar(100) NOT NULL',
            'type' => 'int(11) NOT NULL DEFAULT 1',
            'title_en' => 'text',
            'title_ro' => 'text',
            'title_ru' => 'text',
            'content_en' => 'text',
            'content_ro' => 'text',
            'content_ru' => 'text',
        ), 'ENGINE InnoDB');
	}

	public function safeDown()
	{
        echo "m190205_085625_create_content_block_table does not support migration down.\n";
        return false;
	}
}