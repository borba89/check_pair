<?php

class m190327_143810_add_coor extends CDbMigration
{
	public function up()
	{
        $this->addColumn('realty_address', 'coord_url', 'text');
	}

	public function down()
	{
        $this->dropColumn('realty_address', 'coord_url', 'text');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}