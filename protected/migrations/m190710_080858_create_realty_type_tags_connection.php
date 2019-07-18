<?php

class m190710_080858_create_realty_type_tags_connection extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('realty_type_tags_connection', array(
            'tag_id'=>'integer(11) NOT NULL',
            'realty_type'=>'varchar(255) NOT NULL',
            'PRIMARY KEY(tag_id, realty_type)',
        ), 'ENGINE InnoDB');

        $this->addForeignKey(
            'fk-realty_type_tags_connection-tag_id',
            'realty_type_tags_connection',
            'tag_id',
            'realty_tags',
            'id',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('realty_type_tags_connection');
    }
}