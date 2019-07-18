<?php

class m190116_135144_alter_realty_offer_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->addColumn('realty', 'broker_id', 'integer(11) DEFAULT NULL AFTER `id`');
	}

	public function safeDown()
	{
        echo "m190116_135144_alter_realty_offer_table does not support migration down.\n";
        return false;
	}
}