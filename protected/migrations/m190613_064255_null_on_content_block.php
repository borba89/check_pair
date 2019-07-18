<?php

class m190613_064255_null_on_content_block extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->alterColumn('content_block', 'code', 'varchar(100)');
        $this->alterColumn('content_block', 'name', 'varchar(250)');
    }

	public function safeDown()
	{
        $this->alterColumn('content_block', 'code', 'varchar(100) NOT NULL');
//        $this->alterColumn('content_block', 'name', 'varchar(250) NOT NULL');
    }
}