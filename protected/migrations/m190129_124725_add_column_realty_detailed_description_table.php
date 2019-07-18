<?php

class m190129_124725_add_column_realty_detailed_description_table extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('realty_detailed_description', 'num_balcony', 'integer(11) DEFAULT 0');
	}

	public function safeDown()
	{
        echo "m190129_124725_add_column_realty_detailed_description_table does not support migration down.\n";
        return false;
	}
}