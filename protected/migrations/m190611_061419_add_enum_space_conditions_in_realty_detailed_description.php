<?php

class m190611_061419_add_enum_space_conditions_in_realty_detailed_description extends CDbMigration
{
	public function safeUp()
	{
        $this->alterColumn('realty_detailed_description', 'space_conditions', 'enum(\'gray\',\'white\',\'euro\',\'minor\',\'individual\',\'needed\',\'no_renovation\')');
	}

	public function safeDown()
	{
        $this->alterColumn('realty_detailed_description', 'space_conditions', 'enum(\'gray\',\'white\',\'euro\')');
	}
}