<?php

class m190204_092202_create_slider_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('slider', array(
	        'id'=>'pk',
            'title_en'=>'text',
            'title_ro'=>'text',
            'title_ru'=>'text',
            'subtitle_en'=>'text',
            'subtitle_ro'=>'text',
            'subtitle_ru'=>'text',
        ), 'ENGINE InnoDB');
	}

	public function safeDown()
	{
        echo "m190204_092202_create_slider_table does not support migration down.\n";
        return false;
	}
}