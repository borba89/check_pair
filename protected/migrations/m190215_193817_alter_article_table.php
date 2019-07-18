<?php

class m190215_193817_alter_article_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('article_category', array(
	        'id'=>'pk',
            'title_ru'=>'varchar(255)',
            'title_ro'=>'varchar(255)',
            'title_en'=>'varchar(255)',
        ), 'ENGINE InnoDB');
	    $this->addColumn('article', 'category_id', 'integer(11) NOT NULL AFTER `id`');

	    $this->createIndex('idx_article_category_category_id', 'article', 'category_id');
	    $this->addForeignKey('fk_article_category_category_id', 'article', 'category_id', 'article_category', 'id', 'CASCADE');
	}

	public function safeDown()
	{
        echo "m190215_193817_alter_article_table does not support migration down.\n";
        return false;
	}
}