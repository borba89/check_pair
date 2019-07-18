<?php

class m190125_174127_add_column_realty_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->addColumn('realty', 'subtype', 'varchar(255) DEFAULT NULL AFTER `type`');
	}

	public function safeDown()
	{
        echo "m190125_174127_add_column_realty_table does not support migration down.\n";
        return false;
	}
}