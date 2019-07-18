<?php

class m190311_164826_alter_request_callback_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->renameColumn('request_callback', 'service', 'comment');
	    $this->alterColumn('request_callback', 'comment', 'text');
	}

	public function safeDown()
	{
        echo "m190311_164826_alter_request_callback_table does not support migration down.\n";
        return false;
	}
}