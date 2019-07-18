<?php

class m190129_114519_add_column_realty_detailed_description_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->addColumn('realty_detailed_description', 'project_type', 'varchar(255) DEFAULT NULL');
        $this->addColumn('realty_detailed_description', 'building_type', 'varchar(255) DEFAULT NULL');
        $this->addColumn('realty_detailed_description', 'apartment_position', 'varchar(255) DEFAULT NULL');
	}

	public function safeDown()
	{
        echo "m190129_114519_add_column_realty_detailed_description_table does not support migration down.\n";
        return false;
	}
}