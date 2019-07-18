<?php

class m190304_153811_create_auction_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('auction', array(
	        'id'=>'pk',
            'offer_id'=>'integer(11) NOT NULL',
            'start_bids'=>'integer(11) DEFAULT 1',
            'end_date'=>'datetime',
            'status'=>'integer(11) DEFAULT 1',
        ), 'ENGINE InnoDB');

	    $this->addForeignKey('fk_auction_offer_id', 'auction', 'offer_id', 'realty_offer', 'id', 'CASCADE');

        $this->createTable('auction_bids', array(
            'id'=>'pk',
            'auction_id'=>'integer(11) NOT NULL',
            'name'=>'varchar(255) NOT NULL',
            'phone'=>'varchar(255) NOT NULL',
            'bid'=>'varchar(255) NOT NULL',
            'created_at'=>'datetime',
            'status'=>'integer(11) DEFAULT 1',
        ), 'ENGINE InnoDB');

        $this->addForeignKey('fk_auction_bids_auction_id', 'auction_bids', 'auction_id', 'auction', 'id', 'CASCADE');
	}

	public function safeDown()
	{
        echo "m190304_153811_create_auction_table does not support migration down.\n";
        return false;
	}
}