<?php

class m190312_165820_create_email_template_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('email_template', array(
            'id'=>'pk',
            'name'=>'varchar(255) NOT NULL',
            'variables'=>'varchar(255) NOT NULL',
            'subject_ru'=>'varchar(255) NOT NULL',
            'subject_ro'=>'varchar(255) NOT NULL',
            'subject_en'=>'varchar(255) NOT NULL',
            'message_ru'=>'text NOT NULL',
            'message_ro'=>'text NOT NULL',
            'message_en'=>'text NOT NULL',
            'status'=>'integer(1) DEFAULT 1'
        ), 'ENGINE InnoDB');
	}

	public function safeDown()
	{
        echo "m190312_165820_create_email_template_table does not support migration down.\n";
        return false;
	}
}