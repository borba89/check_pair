<?php

class m190625_095911_realty_tags extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('realty_tags', array(
            'id'=>'pk',
            'title_ru'=>'varchar(255)',
            'title_ro'=>'varchar(255)',
            'title_en'=>'varchar(255)',
        ), 'ENGINE InnoDB');


        $this->createTable('realty_tags_connection', array(
            'tag_id'=>'integer(11) NOT NULL',
            'realty_id'=>'integer(11) NOT NULL',
            'PRIMARY KEY(tag_id, realty_id)',
        ), 'ENGINE InnoDB');

        $this->addForeignKey(
            'fk-realty_tags_connection-tag_id',
            'realty_tags_connection',
            'tag_id',
            'realty_tags',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-realty_tags_connection-realty_id',
            'realty_tags_connection',
            'realty_id',
            'realty',
            'id',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('realty_tags_connection');
        $this->dropTable('realty_tags');
    }
}