<?php

class m190612_143126_request_visit_email_null extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->alterColumn('request_visit', 'email', 'varchar(255)');
        $this->update('building_types', ['name' => 'Кирпич'],'code = \'bricks\'');
        $this->update('building_types', ['name' => 'Панельная'],'code = \'panels\'');
        $this->update('building_types', ['name' => 'Комбинированная'],'code = \'combined\'');
        $this->update('building_types', ['name' => 'Монолит'],'code = \'monolyte\'');
        $this->update('building_types', ['name' => 'Блоки'],'code = \'blocks\'');
        $this->update('building_types', ['name' => 'Котельцовая'],'code = \'limestone\'');
        $this->update('building_types', ['name' => 'Бетон'],'code = \'concrete\'');
        $this->update('building_types', ['name' => 'Ячеистый бетон'],'code = \'cell_conrete\'');
        $this->update('building_types', ['name' => 'Дерево'],'code = \'wood\'');
    }

	public function safeDown()
	{
        $this->alterColumn('request_visit', 'email', 'varchar(255) NOT NULL');
        $this->update('building_types', ['name' => 'Кирпичный'],'code = \'bricks\'');
        $this->update('building_types', ['name' => 'Панельный'],'code = \'panels\'');
        $this->update('building_types', ['name' => 'Комбинированный'],'code = \'combined\'');
        $this->update('building_types', ['name' => 'Монолитый'],'code = \'monolyte\'');
        $this->update('building_types', ['name' => 'Блочный'],'code = \'blocks\'');
        $this->update('building_types', ['name' => 'Котельцовый'],'code = \'limestone\'');
        $this->update('building_types', ['name' => 'Бетон'],'code = \'concrete\'');
        $this->update('building_types', ['name' => 'Ячеистый бетон'],'code = \'cell_conrete\'');
        $this->update('building_types', ['name' => 'Дерево'],'code = \'wood\'');

    }
}