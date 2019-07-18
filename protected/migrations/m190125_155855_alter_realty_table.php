<?php
Yii::import('application.modules.realty.models.Realty');
class m190125_155855_alter_realty_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->alterColumn('realty', 'type', 'varchar(255) DEFAULT "'.Realty::LAND_POT.'"');
	}

	public function safeDown()
	{
        echo "m190125_155855_alter_realty_table does not support migration down.\n";
        return false;
	}
}