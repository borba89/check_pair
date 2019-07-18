<?php

class m190129_144430_create_realty_video_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('realty_offer_video', array(
	        'id'=>'pk',
            'offer_id'=>'integer(11)',
            'url'=>'varchar(255) DEFAULT NULL',
            'code'=>'varchar(64)',
        ));

	    $this->createIndex('idx_realty_offer_video_offer_id', 'realty_offer_video', 'offer_id');
	    $this->addForeignKey('fk_realty_offer_video_offer_id', 'realty_offer_video', 'offer_id', 'realty_offer', 'id', 'CASCADE');
	}

	public function safeDown()
	{
        echo "m190129_144430_create_realty_video_table does not support migration down.\n";
        return false;
	}
}