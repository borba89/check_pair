<?php

class m190131_172816_create_phones_broker_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('phones_broker', array(
	        'id'=>'pk',
            'broker_id'=>'integer(11)',
            'phone'=>'varchar(255)'
        ), 'ENGINE InnoDB');

	    $this->createIndex('idx_phones_broker_broker_id', 'phones_broker', 'broker_id');
	    $this->addForeignKey('fk_phones_broker_broker_id', 'phones_broker', 'broker_id', 'user', 'id', 'CASCADE');
	}

	public function safeDown()
	{
        echo "m190131_172816_create_phones_broker_table does not support migration down.\n";
        return false;
	}
}