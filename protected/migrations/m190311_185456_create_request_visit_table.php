<?php

class m190311_185456_create_request_visit_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('request_visit', array(
	        'id'=>'pk',
            'realty_id'=>'integer(11) NOT NULL',
            'name'=>'varchar(255) NOT NULL',
            'phone'=>'varchar(255) NOT NULL',
            'email'=>'varchar(255) NOT NULL',
            'message'=>'text',
            'created_at'=>'datetime'
        ), 'ENGINE InnoDB');
	}

	public function safeDown()
	{
        echo "m190311_185456_create_request_visit_table does not support migration down.\n";
        return false;
	}
}