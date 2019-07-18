<?php

class m190625_083443_add_bedrooms_realty_detailed_description extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('realty_detailed_description', 'bedrooms', 'integer(11) DEFAULT 0');
    }

    public function safeDown()
    {
        $this->dropColumn('realty_detailed_description', 'bedrooms');
    }
}