<?php

class m190304_120103_create_request_callback_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('request_callback', array(
	        'id'=>'pk',
            'name'=>'varchar(255) NOT NULL',
            'phone'=>'varchar(255) NOT NULL',
            'service'=>'integer(1) NOT NULL',
            'created_at'=>'datetime'
        ));
	}

	public function safeDown()
	{
        echo "m190304_120103_create_request_callback_table does not support migration down.\n";
        return false;
	}
}