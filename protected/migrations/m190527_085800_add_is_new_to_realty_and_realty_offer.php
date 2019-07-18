<?php

class m190527_085800_add_is_new_to_realty_and_realty_offer extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('realty', 'is_new', 'integer(2)');
        $this->addColumn('realty_offer', 'is_new', 'integer(2)');
        $this->insert('city', ['geonameid' => 618427,'city_name_UTF8' => 'Suburbs', 'city_name_ASCII' => 'Suburbs','city_name_ru' => 'Пригород','country' => 'MD']);
    }

	public function safeDown()
	{
        $this->dropColumn('realty', 'is_new', 'integer(2)');
        $this->dropColumn('realty_offer', 'is_new', 'integer(2)');
        $this->delete('city', 'geonameid = 618427');

    }

}