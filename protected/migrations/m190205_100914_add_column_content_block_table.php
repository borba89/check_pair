<?php

class m190205_100914_add_column_content_block_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->addColumn('content_block', 'image', 'varchar(255) DEFAULT NULL');
	}

	public function safeDown()
	{
        echo "m190205_100914_add_column_content_block_table does not support migration down.\n";
        return false;
	}
}