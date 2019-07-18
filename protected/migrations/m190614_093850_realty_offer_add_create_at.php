<?php

class m190614_093850_realty_offer_add_create_at extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('realty_offer', 'created_at', 'datetime');
    }

    public function safeDown()
    {
        $this->dropColumn('realty_offer', 'created_at', 'datetime');
    }
}