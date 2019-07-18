<?php

class m190228_153835_create_comments_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('comments', array(
	        'id'=>'pk',
            'owner_name' => 'varchar(64) NOT NULL',
            'owner_id' => 'int(12) NOT NULL',
            'parent_id' => 'int(12) DEFAULT NULL',
            'creator_id' => 'int(12) DEFAULT NULL',
            'user_name' => 'varchar(128) DEFAULT NULL',
            'user_email' => 'varchar(128) DEFAULT NULL',
            'comment_text' => 'text',
            'create_time' => 'int(11) DEFAULT NULL',
            'update_time' => 'int(11) DEFAULT NULL',
            'status' => 'int(1) NOT NULL DEFAULT 0',
        ));
	}

	public function safeDown()
	{
        echo "m190228_153835_create_comments_table does not support migration down.\n";
        return false;
	}
}