<?php

class SettingsController extends BackendController
{
    public $defaultAction = 'admin';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $view = 'view_custom';
        $this->sidebar_tab = 'custom';
        if ($model->general) {
            $view = 'view_general';
            $this->sidebar_tab = 'general';
        }

        $this->render($view, array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */

    public function actionEditable()
    {
        Yii::import('ext.editable.EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('Settings');  // 'User' is classname of model to be updated
        $es->update();
    }

    public function actionCreate()
    {
        $model = new Settings;
        $this->sidebar_tab = 'custom';

        if (isset($_POST['Settings'])) {
            $model->attributes = $_POST['Settings'];
            if ($model->validate()) {
                Yii::app()->settings->set($model->category, $model->key, $model->value);
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $model->value = @unserialize($model->value);
        /*$view = 'update_custom';
        $this->sidebar_tab = 'custom';
        if($model->general) {
            $view = 'update_general';
            $this->sidebar_tab = 'general';
        }

        if($model->type == Settings::IMAGE)
            $model->scenario = 'image';

        $group = null;
        if($model->sameGroup)
            $group = $model->sameGroup;*/

        if (isset($_POST['Settings'])) {
            /*$param = $_POST['Settings'];
            if(!empty($param[0]) > 0)
            {
                if($this->saveTabular($param));
                    $this->refresh();
            } else {
                $model->attributes=$_POST['Settings'];

                if($model->save())
                    $this->refresh();
            }*/

            $model->attributes = $_POST['Settings'];
            if ($model->validate()) {
                Yii::app()->settings->set($model->category, $model->key, $model->value);
                $this->redirect(array('admin'));
            }
        }

        $this->render('update_general', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Settings('search');

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Settings']))
            $model->attributes = $_GET['Settings'];

        $this->render('admin_general', array(
            'model' => $model,
        ));
    }

    /**
     * Шаблоны писем
     */
    public function actionMail()
    {
        $model = new Settings('search');

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Settings']))
            $model->attributes = $_GET['Settings'];

        $model->category = 'mail';

        $this->render('mail_general', array(
            'model' => $model,
        ));
    }

    /**
     * Страницы сайта
     */
    public function actionPages()
    {
        $active_tab = Yii::app()->request->getParam('active_tab', 'tab1');

        $bg_slider = Yii::app()->settings->get(Settings::PAGES, 'bg_slider');
        $client_say_video_preview = Yii::app()->settings->get(Settings::PAGES, 'client_say_video_preview');
        $slider_numbers = Yii::app()->settings->get(Settings::PAGES, 'slider_numbers');

        $title_featured_en = Yii::app()->settings->get(Settings::PAGES, 'title_featured_en');
        $title_featured_ro = Yii::app()->settings->get(Settings::PAGES, 'title_featured_ro');
        $title_featured_ru = Yii::app()->settings->get(Settings::PAGES, 'title_featured_ru');

        $subtitle_featured_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_featured_en');
        $subtitle_featured_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_featured_ro');
        $subtitle_featured_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_featured_ru');


        $title_lookup_en = Yii::app()->settings->get(Settings::PAGES, 'title_lookup_en');
        $title_lookup_ro = Yii::app()->settings->get(Settings::PAGES, 'title_lookup_ro');
        $title_lookup_ru = Yii::app()->settings->get(Settings::PAGES, 'title_lookup_ru');

        $subtitle_lookup_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_lookup_en');
        $subtitle_lookup_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_lookup_ro');
        $subtitle_lookup_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_lookup_ru');


        $title_recently_en = Yii::app()->settings->get(Settings::PAGES, 'title_recently_en');
        $title_recently_ro = Yii::app()->settings->get(Settings::PAGES, 'title_recently_ro');
        $title_recently_ru = Yii::app()->settings->get(Settings::PAGES, 'title_recently_ru');

        $subtitle_recently_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_recently_en');
        $subtitle_recently_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_recently_ro');
        $subtitle_recently_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_recently_ru');


        $title_client_say_en = Yii::app()->settings->get(Settings::PAGES, 'title_client_say_en');
        $title_client_say_ro = Yii::app()->settings->get(Settings::PAGES, 'title_client_say_ro');
        $title_client_say_ru = Yii::app()->settings->get(Settings::PAGES, 'title_client_say_ru');

        $subtitle_client_say_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_client_say_en');
        $subtitle_client_say_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_client_say_ro');
        $subtitle_client_say_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_client_say_ru');

        $client_say_video = Yii::app()->settings->get(Settings::PAGES, 'client_say_video');

        $footer_text_en = Yii::app()->settings->get(Settings::PAGES, 'footer_text_en');
        $footer_text_ro = Yii::app()->settings->get(Settings::PAGES, 'footer_text_ro');
        $footer_text_ru = Yii::app()->settings->get(Settings::PAGES, 'footer_text_ru');


        $count_partners = Yii::app()->settings->get(Settings::PAGES, 'count_partners');

        $title_partners_en = Yii::app()->settings->get(Settings::PAGES, 'title_partners_en');
        $title_partners_ro = Yii::app()->settings->get(Settings::PAGES, 'title_partners_ro');
        $title_partners_ru = Yii::app()->settings->get(Settings::PAGES, 'title_partners_ru');

        $useful_links_en = Yii::app()->settings->get(Settings::PAGES, 'useful_links_en');
        $useful_links_ro = Yii::app()->settings->get(Settings::PAGES, 'useful_links_ro');
        $useful_links_ru = Yii::app()->settings->get(Settings::PAGES, 'useful_links_ru');

        $contact_us_en = Yii::app()->settings->get(Settings::PAGES, 'contact_us_en');
        $contact_us_ro = Yii::app()->settings->get(Settings::PAGES, 'contact_us_ro');
        $contact_us_ru = Yii::app()->settings->get(Settings::PAGES, 'contact_us_ru');


        $title_subscribe_en = Yii::app()->settings->get(Settings::PAGES, 'title_subscribe_en');
        $title_subscribe_ro = Yii::app()->settings->get(Settings::PAGES, 'title_subscribe_ro');
        $title_subscribe_ru = Yii::app()->settings->get(Settings::PAGES, 'title_subscribe_ru');

        $text_subscribe_en = Yii::app()->settings->get(Settings::PAGES, 'text_subscribe_en');
        $text_subscribe_ro = Yii::app()->settings->get(Settings::PAGES, 'text_subscribe_ro');
        $text_subscribe_ru = Yii::app()->settings->get(Settings::PAGES, 'text_subscribe_ru');

        $meta_title_ru = Yii::app()->settings->get(Settings::PAGES, 'meta_title_ru');
        $meta_title_ro = Yii::app()->settings->get(Settings::PAGES, 'meta_title_ro');
        $meta_title_en = Yii::app()->settings->get(Settings::PAGES, 'meta_title_en');

        $meta_description_ru = Yii::app()->settings->get(Settings::PAGES, 'meta_description_ru');
        $meta_description_ro = Yii::app()->settings->get(Settings::PAGES, 'meta_description_ro');
        $meta_description_en = Yii::app()->settings->get(Settings::PAGES, 'meta_description_en');

        $meta_keywords_ru = Yii::app()->settings->get(Settings::PAGES, 'meta_keywords_ru');
        $meta_keywords_ro = Yii::app()->settings->get(Settings::PAGES, 'meta_keywords_ro');
        $meta_keywords_en = Yii::app()->settings->get(Settings::PAGES, 'meta_keywords_en');

        if (isset($_POST['Settings'])) {

            $dir = Yii::getPathOfAlias('webroot') . '/images/settings/pages/';
            $web = '/images/settings/pages/';
            $webresize = 'images/settings/pages/';

            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }

            if ($_FILES['Settings']['name']['bg_slider']) {

                $logo = CUploadedFile::getInstanceByName('Settings[bg_slider]');
                $path = $dir .'slider_' . $logo->getName();
                $webPath = $web . 'slider_' . $logo->getName();
                $webresizePath = $webresize . 'slider_' . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_slider', $webPath);

                    $image = Yii::app()->iwi->load($webresizePath);
                    $image->resize(1600, 750);
                    $image->save($webresizePath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_slider', '');
                }
            }

            if ($_FILES['Settings']['name']['client_say_video']) {

                $video = CUploadedFile::getInstanceByName('Settings[client_say_video]');
                $path = $dir . $video->getName();
                $webPath = $web . $video->getName();

                if ($video->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'client_say_video', $webPath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'client_say_video', '');
                }
            } elseif (isset($_POST['Settings']['web_client_say_video'])) {
                $web_client_say_video = $_POST['Settings']['web_client_say_video'];
                Yii::app()->settings->set(Settings::PAGES, 'client_say_video', $web_client_say_video);
//                if (preg_match('/^((http|https):\/\/)?(www.)/', $web_client_say_video)) {
//                    Yii::app()->settings->set(Settings::PAGES, 'client_say_video', $web_client_say_video);
//                }
            }

            if ($_FILES['Settings']['name']['client_say_video_preview']) {

                $logo = CUploadedFile::getInstanceByName('Settings[client_say_video_preview]');
                $path = $dir .'client_say_video_preview_' . $logo->getName();
                $webPath = $web . 'client_say_video_preview_' . $logo->getName();
                $webresizePath = $webresize . 'client_say_video_preview_' . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'client_say_video_preview', $webPath);

                    $image = Yii::app()->iwi->load($webresizePath);
                    $image->resize(1600, 395);
                    $image->save($webresizePath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'client_say_video_preview', '');
                }
            }

            foreach ($_POST['Settings'] as $key => $value) {

                Yii::app()->settings->set(Settings::PAGES, $key, $value);
            }

            $this->redirect(array('pages'));
        }


        $this->render('pages_general', array(
            'active_tab' => $active_tab,
            'bg_slider' => $bg_slider,
            'client_say_video_preview' => $client_say_video_preview,
            'slider_numbers' => $slider_numbers,
            'title_featured_en' => $title_featured_en,
            'title_featured_ro' => $title_featured_ro,
            'title_featured_ru' => $title_featured_ru,
            'subtitle_featured_en' => $subtitle_featured_en,
            'subtitle_featured_ro' => $subtitle_featured_ro,
            'subtitle_featured_ru' => $subtitle_featured_ru,
            'title_lookup_en' => $title_lookup_en,
            'title_lookup_ro' => $title_lookup_ro,
            'title_lookup_ru' => $title_lookup_ru,
            'subtitle_lookup_en' => $subtitle_lookup_en,
            'subtitle_lookup_ro' => $subtitle_lookup_ro,
            'subtitle_lookup_ru' => $subtitle_lookup_ru,
            'title_recently_en' => $title_recently_en,
            'title_recently_ro' => $title_recently_ro,
            'title_recently_ru' => $title_recently_ru,
            'subtitle_recently_en' => $subtitle_recently_en,
            'subtitle_recently_ro' => $subtitle_recently_ro,
            'subtitle_recently_ru' => $subtitle_recently_ru,
            'title_client_say_en' => $title_client_say_en,
            'title_client_say_ro' => $title_client_say_ro,
            'title_client_say_ru' => $title_client_say_ru,
            'subtitle_client_say_en' => $subtitle_client_say_en,
            'subtitle_client_say_ro' => $subtitle_client_say_ro,
            'subtitle_client_say_ru' => $subtitle_client_say_ru,
            'client_say_video' => $client_say_video,
            'footer_text_en' => $footer_text_en,
            'footer_text_ro' => $footer_text_ro,
            'footer_text_ru' => $footer_text_ru,
            'title_partners_en' => $title_partners_en,
            'title_partners_ro' => $title_partners_ro,
            'title_partners_ru' => $title_partners_ru,
            'count_partners' => $count_partners,
            'useful_links_en' => $useful_links_en,
            'useful_links_ro' => $useful_links_ro,
            'useful_links_ru' => $useful_links_ru,
            'contact_us_en' => $contact_us_en,
            'contact_us_ro' => $contact_us_ro,
            'contact_us_ru' => $contact_us_ru,
            'title_subscribe_en' => $title_subscribe_en,
            'title_subscribe_ro' => $title_subscribe_ro,
            'title_subscribe_ru' => $title_subscribe_ru,
            'text_subscribe_en' => $text_subscribe_en,
            'text_subscribe_ro' => $text_subscribe_ro,
            'text_subscribe_ru' => $text_subscribe_ru,
            'meta_title_ru' => $meta_title_ru,
            'meta_title_ro' => $meta_title_ro,
            'meta_title_en' => $meta_title_en,
            'meta_description_ru' => $meta_description_ru,
            'meta_description_ro' => $meta_description_ro,
            'meta_description_en' => $meta_description_en,
            'meta_keywords_ru' => $meta_keywords_ru,
            'meta_keywords_ro' => $meta_keywords_ro,
            'meta_keywords_en' => $meta_keywords_en,
        ));
    }

    /**
     * Контактные данные компании
     */
    public function actionCompany()
    {
        Yii::app()->settings->deleteCache(Settings::COMPANY);
        $company_name = Yii::app()->settings->get(Settings::COMPANY, 'company_name');
        $company_logo = Yii::app()->settings->get(Settings::COMPANY, 'company_logo');
        $footer_logo = Yii::app()->settings->get(Settings::COMPANY, 'footer_logo');
        $company_watermark = Yii::app()->settings->get(Settings::COMPANY, 'company_watermark');
        $company_numbers = Yii::app()->settings->get(Settings::COMPANY, 'company_numbers');
        $company_address_ru = Yii::app()->settings->get(Settings::COMPANY, 'company_address_ru');
        $company_address_ro = Yii::app()->settings->get(Settings::COMPANY, 'company_address_ro');
        $company_address_en = Yii::app()->settings->get(Settings::COMPANY, 'company_address_en');
        $company_map = Yii::app()->settings->get(Settings::COMPANY, 'company_map');
        $company_email = Yii::app()->settings->get(Settings::COMPANY, 'company_email');
        $company_email_resume = Yii::app()->settings->get(Settings::COMPANY, 'company_email_resume');

        $socials = Settings::model()->findAll('`key` LIKE "social%"');
        $socials = CHtml::listData($socials, 'key', 'value', 'id');
        $arr = [];
        foreach ($socials as $key => $social) {
            array_push($arr, ['url' => unserialize(array_values($social)[0])]);
            $keyLogo = array_keys($social)[0];
            $str = 'logo_'.$keyLogo;
            $logo = Settings::model()->find('`key` = "'.$str.'" ');
            $arr[count($arr)-1]['logo'] = unserialize($logo->value);
        }
        $socials=$arr;

        if (isset($_POST['Settings'])) {
            foreach ($socials as $key => $social) {
                if((!isset($_POST['Settings']['social'.$key]))){
                    $settings = Settings::model()->findByAttributes(array(
                        'key' => 'social' . $key
                    ));
                    !empty($settings)?$settings->delete():'';
                    $settings = Settings::model()->findByAttributes(array(
                        'key' => 'logo_social' . $key
                    ));
                    !empty($settings)?$settings->delete():'';
                    //Yii::app()->settings->delete(Settings::COMPANY, 'social' . $key);
                    //Yii::app()->settings->delete(Settings::COMPANY, 'logo_social' . $key);
                }

            }
            Yii::app()->settings->deleteCache(Settings::COMPANY);
            $dir = Yii::getPathOfAlias('webroot') . '/images/settings/company/';
            $web = '/images/settings/company/';

            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
            $arr = [
                'company_logo',
                'footer_logo',
                'company_watermark',
            ];
            //$arr = array_merge($arr, array_column($socials, 'logo'));
            foreach ($arr as $key => $value) {
                if (!empty($value)) {
                    if ($_FILES['Settings']['name'][$value]) {

                        $logo = CUploadedFile::getInstanceByName('Settings[' . $value . ']');
                        $path = $dir . $logo->getName();
                        $webPath = $web . $logo->getName();

                        if ($logo->saveAs($path)) {
                            Yii::app()->settings->set(Settings::COMPANY, $value, $webPath);
                        } else {
                            Yii::app()->settings->set(Settings::COMPANY, $value, '');
                        }
                    }
                }
            }
            //array_pop($_FILES['Settings']['name']['logo_social']);
            if (!empty($_FILES['Settings']['name']['logo_social'])) {
            //    var_dump($_FILES['Settings']['name']['logo_social']);die();
                foreach ($_FILES['Settings']['name']['logo_social'] as $key => $value) {

                        $logo = CUploadedFile::getInstanceByName('Settings[logo_social][' . $key . ']');
                        if(!empty($logo)) {
                            $path = $dir . $logo->getName();
                            $webPath = $web . $logo->getName();

                            if ($logo->saveAs($path)) {
                                Yii::app()->settings->set(Settings::COMPANY, 'logo_social' . $key, $webPath);
                            } else {
                                Yii::app()->settings->set(Settings::COMPANY, 'logo_social' . $key, '');
                            }
                        }

                }
            }
         //var_dump($_POST['Settings']);die();
            foreach ($_POST['Settings'] as $key => $value) {

                if(!empty($value)) {
//var_dump($key);var_dump($value);
                    Yii::app()->settings->set(Settings::COMPANY, $key, $value);
        //            die();
                }

            }
       //     die();

            $this->redirect(array('company'));
        }

        $this->render('company_general', array(
            'company_name' => $company_name,
            'company_logo' => $company_logo,
            'footer_logo' => $footer_logo,
            'company_watermark' => $company_watermark,
            'company_numbers' => $company_numbers,
            'company_address_ru' => $company_address_ru,
            'company_address_ro' => $company_address_ro,
            'company_address_en' => $company_address_en,
            'company_map' => $company_map,
            'company_email' => $company_email,
            'company_email_resume' => $company_email_resume,
            'socials' => $socials
        ));
    }

    /**
     * Настройки О нас
     */
    public function actionAbout()
    {
        $bg_about = Yii::app()->settings->get(Settings::PAGES, 'bg_about');
        $bg_since = Yii::app()->settings->get(Settings::PAGES, 'bg_since');
        $title_about_en = Yii::app()->settings->get(Settings::PAGES, 'title_about_en');
        $title_about_ro = Yii::app()->settings->get(Settings::PAGES, 'title_about_ro');
        $title_about_ru = Yii::app()->settings->get(Settings::PAGES, 'title_about_ru');
        $subtitle_about_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_about_en');
        $subtitle_about_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_about_ro');
        $subtitle_about_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_about_ru');
        $title_since_en = Yii::app()->settings->get(Settings::PAGES, 'title_since_en');
        $title_since_ro = Yii::app()->settings->get(Settings::PAGES, 'title_since_ro');
        $title_since_ru = Yii::app()->settings->get(Settings::PAGES, 'title_since_ru');
        $subtitle_since_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_since_en');
        $subtitle_since_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_since_ro');
        $subtitle_since_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_since_ru');

        if (isset($_POST['Settings'])) {

            $dir = Yii::getPathOfAlias('webroot') . '/images/settings/about/';
            $web = '/images/settings/about/';

            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }

            if ($_FILES['Settings']['name']['bg_about']) {

                $logo = CUploadedFile::getInstanceByName('Settings[bg_about]');
                $path = $dir . $logo->getName();
                $webPath = $web . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_about', $webPath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_about', '');
                }
            }

            if ($_FILES['Settings']['name']['bg_since']) {
                $logo = CUploadedFile::getInstanceByName('Settings[bg_since]');
                $path = $dir . $logo->getName();
                $webPath = $web . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_since', $webPath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_since', '');
                }
            }

            foreach ($_POST['Settings'] as $key => $value) {

                Yii::app()->settings->set(Settings::PAGES, $key, $value);
            }

            $this->redirect(array('pages'));
        }

        $this->render('company_general', array(
            'bg_about' => $bg_about,
            'bg_since' => $bg_since,
            'title_about_en' => $title_about_en,
            'title_about_ro' => $title_about_ro,
            'title_about_ru' => $title_about_ru,
            'subtitle_about_en' => $subtitle_about_en,
            'subtitle_about_ro' => $subtitle_about_ro,
            'subtitle_about_ru' => $subtitle_about_ru,
            'title_since_en' => $title_since_en,
            'title_since_ro' => $title_since_ro,
            'title_since_ru' => $title_since_ru,
            'subtitle_since_en' => $subtitle_since_en,
            'subtitle_since_ro' => $subtitle_since_ro,
            'subtitle_since_ru' => $subtitle_since_ru,
        ));
    }

    public function actionPropertyList()
    {
        $bg_property_list = Yii::app()->settings->get(Settings::PAGES, 'bg_property_list');
        $title_property_list_en = Yii::app()->settings->get(Settings::PAGES, 'title_property_list_en');
        $title_property_list_ro = Yii::app()->settings->get(Settings::PAGES, 'title_property_list_ro');
        $title_property_list_ru = Yii::app()->settings->get(Settings::PAGES, 'title_property_list_ru');
        $subtitle_property_list_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_property_list_en');
        $subtitle_property_list_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_property_list_ro');
        $subtitle_property_list_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_property_list_ru');

        if (isset($_POST['Settings'])) {

            $dir = Yii::getPathOfAlias('webroot') . '/images/settings/property_list/';
            $web = '/images/settings/property_list/';

            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }

            if ($_FILES['Settings']['name']['bg_property_list']) {

                $logo = CUploadedFile::getInstanceByName('Settings[bg_property_list]');
                $path = $dir . $logo->getName();
                $webPath = $web . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_property_list', $webPath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_property_list', '');
                }
            }

            foreach ($_POST['Settings'] as $key => $value) {

                Yii::app()->settings->set(Settings::PAGES, $key, $value);
            }

            $this->redirect(array('pages'));
        }

        $this->render('pages_general', array(
            $bg_property_list = $bg_property_list,
            $title_property_list_en = $title_property_list_en,
            $title_property_list_ro = $title_property_list_ro,
            $title_property_list_ru = $title_property_list_ru,
            $subtitle_property_list_en = $subtitle_property_list_en,
            $subtitle_property_list_ro = $subtitle_property_list_ro,
            $subtitle_property_list_ru = $subtitle_property_list_ru,
        ));
    }

    public function actionVacancy()
    {
        $bg_vacancy = Yii::app()->settings->get(Settings::PAGES, 'bg_vacancy');
        $title_vacancy_en = Yii::app()->settings->get(Settings::PAGES, 'title_vacancy_en');
        $title_vacancy_ro = Yii::app()->settings->get(Settings::PAGES, 'ttitle_vacancy_ro');
        $title_vacancy_ru = Yii::app()->settings->get(Settings::PAGES, 'title_vacancy_ru');
        $subtitle_vacancy_en = Yii::app()->settings->get(Settings::PAGES, 'subtitle_vacancy_en');
        $subtitle_vacancy_ro = Yii::app()->settings->get(Settings::PAGES, 'subtitle_vacancy_ro');
        $subtitle_vacancy_ru = Yii::app()->settings->get(Settings::PAGES, 'subtitle_vacancy_ru');

        if (isset($_POST['Settings'])) {

            $dir = Yii::getPathOfAlias('webroot') . '/images/settings/vacancy/';
            $web = '/images/settings/vacancy/';

            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }

            if ($_FILES['Settings']['name']['bg_vacancy']) {

                $logo = CUploadedFile::getInstanceByName('Settings[bg_vacancy]');
                $path = $dir . $logo->getName();
                $webPath = $web . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_vacancy', $webPath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_vacancy', '');
                }
            }

            foreach ($_POST['Settings'] as $key => $value) {

                Yii::app()->settings->set(Settings::PAGES, $key, $value);
            }

            $this->redirect(array('pages'));
        }
    }

    public function actionContact()
    {
        if (isset($_POST['Settings'])) {

            $dir = Yii::getPathOfAlias('webroot') . '/images/settings/contact/';
            $web = '/images/settings/contact/';

            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }

            if ($_FILES['Settings']['name']['bg_contact']) {

                $logo = CUploadedFile::getInstanceByName('Settings[bg_contact]');
                $path = $dir . $logo->getName();
                $webPath = $web . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_contact', $webPath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_contact', '');
                }
            }

            foreach ($_POST['Settings'] as $key => $value) {

                Yii::app()->settings->set(Settings::PAGES, $key, $value);
            }

            $this->redirect(array('pages'));
        }
    }

    public function actionBlog()
    {
        if (isset($_POST['Settings'])) {

            $dir = Yii::getPathOfAlias('webroot') . '/images/settings/blog/';
            $web = '/images/settings/blog/';

            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }

            if ($_FILES['Settings']['name']['bg_blog']) {

                $logo = CUploadedFile::getInstanceByName('Settings[bg_blog]');
                $path = $dir . $logo->getName();
                $webPath = $web . $logo->getName();

                if ($logo->saveAs($path)) {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_blog', $webPath);
                } else {
                    Yii::app()->settings->set(Settings::PAGES, 'bg_blog', '');
                }
            }

            foreach ($_POST['Settings'] as $key => $value) {

                Yii::app()->settings->set(Settings::PAGES, $key, $value);
            }

            $this->redirect(array('pages'));
        }
    }

    public function actionPropertySingle()
    {
        $title_button_rate_ru = Yii::app()->settings->get(Settings::PAGES, 'title_button_rate_ru');
        $title_property_print_ru = Yii::app()->settings->get(Settings::PAGES, 'title_property_print_ru');
        $title_property_agent_ru = Yii::app()->settings->get(Settings::PAGES, 'title_property_agent_ru');
        $title_property_desc_ru = Yii::app()->settings->get(Settings::PAGES, 'title_property_desc_ru');
        $title_property_related_ru = Yii::app()->settings->get(Settings::PAGES, 'title_property_related_ru');
        $title_property_feat_ru = Yii::app()->settings->get(Settings::PAGES, 'title_property_feat_ru');
        $title_button_rate_ro = Yii::app()->settings->get(Settings::PAGES, 'title_button_rate_ro');
        $title_property_print_ro = Yii::app()->settings->get(Settings::PAGES, 'title_property_print_ro');
        $title_property_agent_ro = Yii::app()->settings->get(Settings::PAGES, 'title_property_agent_ro');
        $title_property_desc_ro = Yii::app()->settings->get(Settings::PAGES, 'title_property_desc_ro');
        $title_property_related_ro = Yii::app()->settings->get(Settings::PAGES, 'title_property_related_ro');
        $title_property_feat_ro = Yii::app()->settings->get(Settings::PAGES, 'title_property_feat_ro');
        $title_button_rate_en = Yii::app()->settings->get(Settings::PAGES, 'title_button_rate_en');
        $title_property_print_en = Yii::app()->settings->get(Settings::PAGES, 'title_property_print_en');
        $title_property_agent_en = Yii::app()->settings->get(Settings::PAGES, 'title_property_agent_en');
        $title_property_desc_en = Yii::app()->settings->get(Settings::PAGES, 'title_property_desc_en');
        $title_property_related_en = Yii::app()->settings->get(Settings::PAGES, 'title_property_related_en');
        $title_property_feat_en = Yii::app()->settings->get(Settings::PAGES, 'title_property_feat_en');

        if (isset($_POST['Settings'])) {

            foreach ($_POST['Settings'] as $key => $value) {

                Yii::app()->settings->set(Settings::PAGES, $key, $value);
            }

            $this->redirect(array('pages'));
        }
    }

    public function actionIndex()
    {
        /**
         * Get model from setting key ad creation type
         */
        $model = Settings::model()->findByAttributes(array(
            'key' => 'ad_creation'
        ));

        /**
         * If model not found, create new record
         */
        if (!$model) {
            Yii::app()->settings->set(Settings::GENERAL, 'ad_creation', 1);
            $model = $model = Settings::model()->findByAttributes(array(
                'key' => 'ad_creation'
            ));
        }

        /**
         * Set new value for setting key
         */
        if (Yii::app()->request->isPostRequest) {
            $value = Yii::app()->request->getPost('Settings');
            if ($value !== null) {
                Yii::app()->settings->set(Settings::GENERAL, 'ad_creation', 1);
            } else {
                Yii::app()->settings->set(Settings::GENERAL, 'ad_creation', 0);
            }


        }

        /**
         * Checked value for checkbox
         */
        $selected = Yii::app()->settings->get(Settings::GENERAL, 'ad_creation');

        $this->render('index', array(
            'model' => $model,
            'selected' => $selected
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Settings::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'settings-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function saveTabular($param)
    {
        $flag = true;
        foreach ($param as $i => $item) {
            $setting = Settings::model()->findByPk($item['cur_id']);
            $setting->attributes = $item;
            $uploadedFile = CUploadedFile::getInstance($setting, '[' . $i . ']value');
            if (!empty($uploadedFile))
                $setting->dinamicImage($setting, '[' . $i . ']value');

            if (!empty($item['image_remove']))
                $setting->image = "";

            if (!$setting->save()) {
                $flag = false;
                Yii::log(CHtml::errorSummary($setting), "error");
            }
        }
        return $flag;
    }
}
