<?php

class m190212_113449_add_column_vacancy_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->addColumn('vacancy', 'lang', 'varchar(6)');
	}

	public function safeDown()
	{
        echo "m190212_113449_add_column_vacancy_table does not support migration down.\n";
        return false;
	}
}