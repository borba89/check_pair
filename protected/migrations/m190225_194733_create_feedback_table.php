<?php

class m190225_194733_create_feedback_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('feedback', array(
	        'id'=>'pk',
            'name'=>'varchar(255)',
            'email'=>'varchar(255)',
            'subject'=>'text',
            'message'=>'text',
            'status'=>'integer(1) DEFAULT 0'
        ));
	}

	public function safeDown()
	{
        echo "m190225_194733_create_feedback_table does not support migration down.\n";
        return false;
	}
}