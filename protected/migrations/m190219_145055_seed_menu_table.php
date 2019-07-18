<?php

class m190219_145055_seed_menu_table extends CDbMigration
{
	public function safeUp()
	{
	    $sql1 = "INSERT INTO `menu` (`id`, `name`, `enabled`, `vertical`, `rtl`, `upward`, `theme`, `description`) VALUES(1, 'topmenu', 1, 0, 0, 0, 'default', 'Top Menu');";

	    Yii::app()->db->createCommand($sql1)->execute();

	    $sql2 = "INSERT INTO `menu_item` (`id`, `menu_id`, `parent_id`, `depth`, `lft`, `rgt`, `name_en`, `name_ru`, `name_ro`, `enabled`, `target`, `description`, `link_en`, `link_ru`, `link_ro`, `type`, `role`) VALUES
(1, 1, 0, 1, 1, 2, 'Home', 'Главная', 'Home', 1, NULL, 'home page', '/', '/', '/', 'url', 'all'),
(2, 1, 0, 1, 3, 4, 'About', 'О нас', 'About', 1, NULL, 'About us', '/about-us', '/о-нас', '/about-us', 'url', 'all'),
(3, 1, 0, 1, 5, 6, 'Realty list', 'Недвижимость', 'Realty list', 1, NULL, 'Список объявлений', '/realty', '/недвижимость', '/imobiliare', 'url', 'all'),
(4, 1, 0, 1, 7, 8, 'Vacancy', 'Вакансии', 'Вакансии', 1, NULL, 'Объявления вакансии', '/career', '/вакансии', '/cariera', 'url', 'all'),
(5, 1, 0, 1, 9, 10, 'Contacts', 'Контакты', 'Contacts', 1, NULL, 'Контакты', '/contacts', '/контакты', '/contacte', 'url', 'all');
";
        Yii::app()->db->createCommand($sql2)->execute();
	}

	public function safeDown()
	{
        echo "m190219_145055_seed_menu_table does not support migration down.\n";
        return false;
	}
}