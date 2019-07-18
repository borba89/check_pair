<?php

class m190604_103449_create_realty_offer_user_view extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('realty_offer_user_view', array(
            'user_id'=>'integer(11) NOT NULL',
            'realty_offer_id'=>'integer(11) NOT NULL',
            'viewed_ru'=>'integer(1)',
            'viewed_ro'=>'integer(1)',
            'viewed_en'=>'integer(1)',
            'PRIMARY KEY(user_id, realty_offer_id)',
        ), 'ENGINE InnoDB');

        // creates index for column `housing_id`
        $this->createIndex(
            'idx-user_view-user_id',
            'realty_offer_user_view',
            'user_id'
        );

        // add foreign key for table `housing`
        $this->addForeignKey(
            'fk-user_view-user_id',
            'realty_offer_user_view',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `consult_id`
        $this->createIndex(
            'idx-user_view-user_realty_offer_id',
            'realty_offer_user_view',
            'realty_offer_id'
        );

        // add foreign key for table `consult`
        $this->addForeignKey(
            'fk-user_view-user_realty_offer_id',
            'realty_offer_user_view',
            'realty_offer_id',
            'realty_offer',
            'id',
            'CASCADE'
        );
    }

	public function safeDown()
	{
        $this->dropTable('realty_offer_user_view');
	}

}