<?php

class m190626_140545_building_project extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('building_project', array(
            'id'=>'pk',
            'title_ru'=>'varchar(255)',
            'title_ro'=>'varchar(255)',
            'title_en'=>'varchar(255)',
        ), 'ENGINE InnoDB');

        $this->insert('building_project', ['title_ru' => 'Индивидуальная','title_ro' => 'Individuală', 'title_en' => 'Special']);

        $this->update('realty_detailed_description', ['project_type' => '0']);

        $this->alterColumn('realty_detailed_description', 'project_type', 'integer');

//        $this->createIndex('idx_project_type', 'realty_detailed_description', 'project_type');

//        $this->addForeignKey(
//            'fk-1-id',
//            'realty_detailed_description',
//            'project_type',
//            'building_project',
//            'id',
//            'CASCADE'
//        );

    }

    public function safeDown()
    {
        $this->dropTable('building_project');
        $this->alterColumn('realty_detailed_description', 'project_type', 'varchar(255)');

    }
}