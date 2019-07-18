<?php

class m190304_101954_create_subscribe_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('subscribe', array(
	        'id'=>'pk',
            'email'=>'varchar(255) NOT NULL',
            'created_at'=>'datetime',
        ), 'ENGINE InnoDB');
	}

	public function safeDown()
	{
        echo "m190304_101954_create_subscribe_table does not support migration down.\n";
        return false;
	}
}