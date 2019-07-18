<?php

class m190125_182341_alter_column_realty_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->dropColumn('realty', 'subtype');
	    Yii::app()->db->createCommand("UPDATE `realty_detailed_description` SET `type`=NULL")->execute();
	}

	public function safeDown()
	{
        echo "m190125_182341_alter_column_realty_table does not support migration down.\n";
        return false;
	}
}