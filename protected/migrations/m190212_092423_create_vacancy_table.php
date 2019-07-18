<?php

class m190212_092423_create_vacancy_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('vacancy', array(
	        'id'=>'pk',
            'title_en'=>'text',
            'title_ro'=>'text',
            'title_ru'=>'text',
            'subtitle_en'=>'text',
            'subtitle_ro'=>'text',
            'subtitle_ru'=>'text',
            'text_en'=>'text',
            'text_ro'=>'text',
            'text_ru'=>'text',
            'image'=>'varchar(255)'
        ), 'ENGINE InnoDB');
	}

	public function safeDown()
	{
        echo "m190212_092423_create_vacancy_table does not support migration down.\n";
        return false;
	}
}