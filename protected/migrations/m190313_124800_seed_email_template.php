<?php

class m190313_124800_seed_email_template extends CDbMigration
{
	public function safeUp()
	{
	    $sql = 'INSERT INTO `email_template` (`id`, `name`, `variables`, `subject_ru`, `subject_ro`, `subject_en`, `message_ru`, `message_ro`, `message_en`, `status`) VALUES
(2, \'test\', \'\', \'Привет {user}\', \'Hello {user}\', \'Hello {user}\', \'<h1>Это тестовая <strong>{test}</strong> переменная</h1>\r\n<ol style=\"list-style-type: undefined;\">\r\n<li>еще одна {first}</li>\r\n<li>и вторая <em>{second}</em></li>\r\n</ol>\', \'<p>Это тестовая {test} переменная</p>\r\n<ol style=\"list-style-type: undefined;\">\r\n<li>еще одна {first}</li>\r\n<li>и вторая {second}</li>\r\n</ol>\', \'<p>Это тестовая {test} переменная</p>\r\n<ol style=\"list-style-type: undefined;\">\r\n<li>еще одна {first}</li>\r\n<li>и вторая {second}</li>\r\n</ol>\', 1);';
	    Yii::app()->db->createCommand($sql)->execute();
	}

	public function safeDown()
	{
        echo "m190313_124800_seed_email_template does not support migration down.\n";
        return false;
	}
}