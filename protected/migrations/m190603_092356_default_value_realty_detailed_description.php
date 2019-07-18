<?php

class m190603_092356_default_value_realty_detailed_description extends CDbMigration
{

	public function safeUp()
	{
        $this->alterColumn('realty_detailed_description', 'parcel_size', 'integer(11) NOT NULL DEFAULT 0');
        $this->alterColumn('realty_detailed_description', 'living_space_size', 'integer(11) NOT NULL DEFAULT 0');
        $this->alterColumn('realty_detailed_description', 'total_space_size', 'integer(11) NOT NULL DEFAULT 0');
        $this->alterColumn('realty_detailed_description', 'number_of_floors', 'integer(11) NOT NULL DEFAULT 0');
        $this->alterColumn('realty_detailed_description', 'newly_built', 'integer(1) NOT NULL DEFAULT 0');
        $this->alterColumn('realty_detailed_description', 'floor', 'integer(3) NOT NULL DEFAULT 0');
        $this->alterColumn('realty_detailed_description', 'rooms', 'integer(3) NOT NULL DEFAULT 0');
    }

	public function safeDown()
	{
        $this->alterColumn('realty_detailed_description', 'living_space_size', 'integer(11) NOT NULL');
        $this->alterColumn('realty_detailed_description', 'total_space_size', 'integer(11) NOT NULL');
        $this->alterColumn('realty_detailed_description', 'number_of_floors', 'integer(11) NOT NULL');
        $this->alterColumn('realty_detailed_description', 'newly_built', 'integer(1) NOT NULL');
        $this->alterColumn('realty_detailed_description', 'floor', 'integer(3) NOT NULL');
        $this->alterColumn('realty_detailed_description', 'rooms', 'integer(3) NOT NULL');
    }
}