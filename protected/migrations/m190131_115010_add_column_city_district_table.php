<?php

class m190131_115010_add_column_city_district_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->addColumn('city_district', 'suburb', 'integer(1) DEFAULT 0');
	}

	public function safeDown()
	{
        echo "m190131_115010_add_column_city_district_table does not support migration down.\n";
        return false;
	}
}