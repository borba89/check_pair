<?php
Yii::import('backend.components.BackendController');
Yii::import('backend.components.multiapload.*');

class RealtyOfferController extends BackendController
{
    public $sidebar_tab = "realty-offer";

    public function actions()
    {
        return array(
            'upload' => 'UploadAction',
            'gallery'=>'GalleryAction',
            'imagedel'=>'ImagedelAction',
            'mainimage'=>'MainimageAction',

            'admin'=>'DAdminAction',
            'view' => 'DViewAction',
            'create' => 'DCreateAction',
            'delete' => 'DDeleteAction',
            'update'=> 'DUpdateAction',
        );
    }

    public function actionAdmin()
    {
        $model=new RealtyOffer('search');
        $model->unsetAttributes();  // clear any default values
        //Не показывать созданные, но не сохраненные обьявления
        $model->is_new=0;

        //Очистка от несохраненных моделей//
        RealtyOffer::model()->deleteAll('is_new = :is_new AND created_at <= DATE_SUB(NOW(),INTERVAL 1 DAY)', array(':is_new' => 1));
        Realty::model()->deleteAll('is_new = :is_new AND created <= DATE_SUB(CURDATE(),INTERVAL 1 DAY)', array(':is_new' => 1));

        if(isset($_GET['ContentBlock'])){
            $model->attributes=$_GET['ContentBlock'];
        }
        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionCreate()
    {
        $model = $this->createModel();
        $step = Yii::app()->request->getParam('step', null);
        $model->scenario = $step;

        $realty = $model->realty;
        if (!$realty) {
            $realty = new Realty();
        }

        $videos = new RealtyOfferVideo();

        if (isset($_POST['RealtyOffer'])) {
            $model->attributes = $_POST['RealtyOffer'];
            $this->performAjaxValidation($model);

            //echo CVarDumper::dump($_POST,10,true);exit;
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('create',array(
            'model'=>$model,
            'realty' => $realty,
            'videos'=>$videos
        ));
    }

    public function actionCreateAd()
    {
        if (isset($_POST['IsNew'])) {
            $IsNew = false;
        } else {
            $IsNew = true;
        }
        if ($IsNew) {
            //Очистка от несохраненных моделей//
            RealtyOffer::model()->deleteAll('is_new = :is_new AND created_at <= DATE_SUB(NOW(),INTERVAL 1 DAY)', array(':is_new' => 1));
            Realty::model()->deleteAll('is_new = :is_new AND created <= DATE_SUB(CURDATE(),INTERVAL 1 DAY)', array(':is_new' => 1));
            //Очистка всех картинок из базы данных отсутствующих объявлений и недвижимости
            RealtyOffer::clearImagesNonExistRealtyOffer();
            Realty::clearImagesNonExistRealty();

        $model = $this->createModel();
        $realty = new Realty();
        $realty->address = '';
        $realty->description = '';
        $realty->space_sq_meters = '';
        $realty->is_new = 1;
        $realty->created = date('Y-m-d');
        $realty->save(false);
        $model->realty_id = $realty->id;
        $model->lng = 'ru';
        $model->ammount = '';
        $model->currency = RealtyOffer::EURO;
        $model->title_ru = '';
        $model->title_ro = '';
        $model->title_en = '';
        $model->street_ru = '';
        $model->street_ro = '';
        $model->street_en = '';
        $model->description_ru = '';
        $model->description_ro = '';
        $model->description_en = '';
        $model->views_ru = '';
        $model->views_ro = '';
        $model->views_en = '';
        $model->add_favorite_ru = '';
        $model->add_favorite_ro = '';
        $model->add_favorite_en = '';
        $model->main_page = 0;
        $model->is_active = 0;
        $model->remove_favorite = 0;
        $model->is_new = 1;
        $model->save(false);
        } else {
            if (isset($_POST['model_id'])) {

                $model = $this->loadModel($_POST['model_id']);

                $realty = $model->realty;
                if (!$realty) {
                    $realty = new Realty();
                }
            } else {
                $model = $this->createModel();
            }
            $model->is_active = 1;
        }
        //$model->lng = 'ru';
        $step = Yii::app()->request->getParam('step', null);
        $model->scenario = $step;
        //        $model->scenario = 'ad_step1';

        $address = new RealtyAddress();
        $realtyDetailed = new RealtyDetailedDescription();
        $videos = new RealtyOfferVideo();

        if (isset($_POST['RealtyOffer'])) {
            //echo CVarDumper::dump($_POST,10,true);

            $transaction = Yii::app()->db->beginTransaction();

            try{
                $realty->attributes = $_POST['Realty'];
                $address->attributes = $_POST['RealtyAddress'];
                $model->attributes = $_POST['RealtyOffer'];
                $realtyDetailed->attributes = !empty($_POST['RealtyDetailedDescription'])?$_POST['RealtyDetailedDescription']:'';
                /**
                 * Своя аякс валидация
                 */
                $this->performAjaxValidationAd($model);

                /**
                 * Заполнение полей связанной модели Relation
                 */
                // Временно пока не понадобится вкладка ОПИСАНИЕ
                if ($model->street_ru) {
                $curr_lang = Yii::app()->language;
                Yii::app()->language = 'ru';
//                $model->title_ru =  $realty->getRealtyType($realty->type) . ' '. $model->street_ru;

                    switch ($realty->type) {
                        case Realty::APARTMENTS:
                            $model->title_ru = Yii::t("RealtyModule.realty", 'Квартира') . ' - ' .
                                Yii::t("RealtyModule.realty",
                                    '{n} комната|{n} комнаты|{n} комнат',
                                    array($realtyDetailed->rooms, '{n}' => $realtyDetailed->rooms)
                                );
                            break;
                        case Realty::ESTATE:
                            $model->title_ru = Yii::t("RealtyModule.realty", 'Дом') . ' - ' .
                                Yii::t("RealtyModule.realty",
                                    '{n} спальня|{n} спальни|{n} спален',
                                    array($realtyDetailed->bedrooms, '{n}' => $realtyDetailed->bedrooms)
                                );
                            break;
                        case Realty::LAND_POT:
                            $model->title_ru = Yii::t("RealtyModule.realty", 'Участок') . ' - ' .
                                mb_strtolower($realtyDetailed->getLandType($realtyDetailed->type));
                            break;
                        case Realty::COMMERTIAL:
                            $model->title_ru = Yii::t("RealtyModule.realty", 'Коммерческая площадь');
                            break;
                    }
                Yii::app()->language = $curr_lang;

                }
                if ($model->street_ro) {
                $curr_lang = Yii::app()->language;
                Yii::app()->language = 'ro';
//                $model->title_ro =  $realty->getRealtyType($realty->type) . ' '. $model->street_ro;
                    switch ($realty->type) {
                        case Realty::APARTMENTS:
                            $model->title_ro = Yii::t("RealtyModule.realty", 'Квартира') . ' - ' .
                                Yii::t("RealtyModule.realty",
                                    '{n} комната|{n} комнаты|{n} комнат',
                                    array($realtyDetailed->rooms, '{n}' => $realtyDetailed->rooms)
                                );
                            break;
                        case Realty::ESTATE:
                            $model->title_ro = Yii::t("RealtyModule.realty", 'Дом') . ' - ' .
                                Yii::t("RealtyModule.realty",
                                    '{n} спальня|{n} спальни|{n} спален',
                                    array($realtyDetailed->bedrooms, '{n}' => $realtyDetailed->bedrooms)
                                );
                            break;
                        case Realty::LAND_POT:
                            $model->title_ro = Yii::t("RealtyModule.realty", 'Участок') . ' - ' .
                                mb_strtolower($realtyDetailed->getLandType($realtyDetailed->type));
                            break;
                        case Realty::COMMERTIAL:
                            $model->title_ro = Yii::t("RealtyModule.realty", 'Коммерческая площадь');
                            break;
                    }
                Yii::app()->language = $curr_lang;

                }
                if ($model->street_en) {
                $curr_lang = Yii::app()->language;
                Yii::app()->language = 'en';
//                $model->title_en =  $realty->getRealtyType($realty->type) . ' '. $model->street_en;
                    switch ($realty->type) {
                        case Realty::APARTMENTS:
                            $model->title_en = Yii::t("RealtyModule.realty", 'Квартира') . ' - ' .
                                Yii::t("RealtyModule.realty",
                                    '{n} комната|{n} комнаты|{n} комнат',
                                    array($realtyDetailed->rooms, '{n}' => $realtyDetailed->rooms)
                                );
                            break;
                        case Realty::ESTATE:
                            $model->title_en = Yii::t("RealtyModule.realty", 'Дом') . ' - ' .
                                Yii::t("RealtyModule.realty",
                                    '{n} спальня|{n} спальни|{n} спален',
                                    array($realtyDetailed->bedrooms, '{n}' => $realtyDetailed->bedrooms)
                                );
                            break;
                        case Realty::LAND_POT:
                            $model->title_en = Yii::t("RealtyModule.realty", 'Участок') . ' - ' .
                                mb_strtolower($realtyDetailed->getLandType($realtyDetailed->type));
                            break;
                        case Realty::COMMERTIAL:
                            $model->title_en = Yii::t("RealtyModule.realty", 'Коммерческая площадь');
                            break;
                    }
                Yii::app()->language = $curr_lang;

                }

                switch ($model->lng){
                    case 'ru':
                        $model->scenario = 'ru';
                        $address->street = $model->street_ru;
                        $realty->addressStreet = $model->street_ru;
                        $realty->description = $model->description_ru;
                        break;
                    case 'ro':
                        $model->scenario = 'ro';
                        $address->street = $model->street_ro;
                        $realty->addressStreet = $model->street_ro;
                        $realty->description = $model->description_ro;
                        break;
                    case 'en':
                        $model->scenario = 'en';
                        $address->street = $model->street_en;
                        $realty->addressStreet = $model->street_en;
                        $realty->description = $model->description_en;
                        break;
                    default:
                        $model->scenario = 'ru';
                        $address->street = $model->street_ru;
                        $realty->addressStreet = $model->street_ru;
                        $realty->description = $model->description_ru;
                }

                $realty->created = date('Y-m-d');

                $realty->is_new = 0;

                if($realty->save(false)){
                    $model->realty_id = $realty->id;
                    $model->is_new = 0;
                    if ($model->save(false)) {
                        $transaction->commit();
                        $this->redirect(array('admin'));
                    }
                }

            }catch(Exception $e){
                $transaction->rollback();
                $this->redirect(array('admin'));
            }

        }

        $realtyTypeTags = RealtyTags::getTagsByRealtyTypeOrderByTitle($realty->type);

        $this->render('createAd',array(
            'model'=>$model,
            'realty' => $realty,
            'address'=>$address,
            'realtyDetailed' => $realtyDetailed,
            'videos'=>$videos,
            'IsNew' => $IsNew,
            'realtyTypeTags' => $realtyTypeTags,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $step = Yii::app()->request->getParam('step', null);
        $model->scenario = $step;

        $realty = $model->realty;
        if (!$realty) {
            $realty = new Realty();
        }

        $existVideos = $model->realtyOfferVideos;

        $videos = new RealtyOfferVideo();


        if (isset($_POST['RealtyOffer'])) {
            $model->attributes = $_POST['RealtyOffer'];
            $this->performAjaxValidation($model);

            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('update',array(
            'model' => $model,
            'realty' => $realty,
            'videos'=>$videos,
            'existVideos'=>$existVideos,
        ));
    }

    public function actionUpdateAd($id)
    {
        $model = $this->loadModel($id);
        $model->lng = $model->getSelectedLang();
        $step = Yii::app()->request->getParam('step', null);
        $model->scenario = $step;

        $realty = $model->realty;
        if (!$realty) {
            $realty = new Realty();
        }

        $address = $realty->addressTable;
        if(!$address){
            $address = new RealtyAddress();
        }

        $realtyDetailed = $realty->realtyDetailed;
        if(!$realtyDetailed){
            $realtyDetailed = new RealtyDetailedDescription();
        }

        $existVideos = $model->realtyOfferVideos;

        $videos = new RealtyOfferVideo();

        $this->performAjaxValidationAd($model);

        if (isset($_POST['RealtyOffer'])) {
            $model->attributes = $_POST['RealtyOffer'];
            $realty->attributes = $_POST['Realty'];
            $address->attributes = $_POST['RealtyAddress'];
            $realtyDetailed->attributes = $_POST['RealtyDetailedDescription'];

            if ($model->street_ru) {
                $curr_lang = Yii::app()->language;
                Yii::app()->language = 'ru';
//                $model->title_ru =  $realty->getRealtyType($realty->type) . ' '. $model->street_ru;
                switch ($realty->type) {
                    case Realty::APARTMENTS:
                        $model->title_ru = Yii::t("RealtyModule.realty", 'Квартира') . ' - ' .
                            Yii::t("RealtyModule.realty",
                                '{n} комната|{n} комнаты|{n} комнат',
                                array($realtyDetailed->rooms, '{n}' => $realtyDetailed->rooms)
                            );
                        break;
                    case Realty::ESTATE:
                        $model->title_ru = Yii::t("RealtyModule.realty", 'Дом') . ' - ' .
                            Yii::t("RealtyModule.realty",
                                '{n} спальня|{n} спальни|{n} спален',
                                array($realtyDetailed->bedrooms, '{n}' => $realtyDetailed->bedrooms)
                            );
                        break;
                    case Realty::LAND_POT:
                        $model->title_ru = Yii::t("RealtyModule.realty", 'Участок') . ' - ' .
                            mb_strtolower($realtyDetailed->getLandType($realtyDetailed->type));
                        break;
                    case Realty::COMMERTIAL:
                        $model->title_ru = Yii::t("RealtyModule.realty", 'Коммерческая площадь');
                        break;
                }
                Yii::app()->language = $curr_lang;
            }
            if ($model->street_ro) {
                $curr_lang = Yii::app()->language;
                Yii::app()->language = 'ro';
//                $model->title_ro =  $realty->getRealtyType($realty->type) . ' '. $model->street_ro;
                switch ($realty->type) {
                    case Realty::APARTMENTS:
                        $model->title_ro = Yii::t("RealtyModule.realty", 'Квартира') . ' - ' .
                            Yii::t("RealtyModule.realty",
                                '{n} комната|{n} комнаты|{n} комнат',
                                array($realtyDetailed->rooms, '{n}' => $realtyDetailed->rooms)
                            );
                        break;
                    case Realty::ESTATE:
                        $model->title_ro = Yii::t("RealtyModule.realty", 'Дом') . ' - ' .
                            Yii::t("RealtyModule.realty",
                                '{n} спальня|{n} спальни|{n} спален',
                                array($realtyDetailed->bedrooms, '{n}' => $realtyDetailed->bedrooms)
                            );
                        break;
                    case Realty::LAND_POT:
                        $model->title_ro = Yii::t("RealtyModule.realty", 'Участок') . ' - ' .
                            mb_strtolower($realtyDetailed->getLandType($realtyDetailed->type));
                        break;
                    case Realty::COMMERTIAL:
                        $model->title_ro = Yii::t("RealtyModule.realty", 'Коммерческая площадь');
                        break;
                }
                Yii::app()->language = $curr_lang;
            }
            if ($model->street_en) {
                $curr_lang = Yii::app()->language;
                Yii::app()->language = 'en';
//                $model->title_en =  $realty->getRealtyType($realty->type) . ' '. $model->street_en;
                switch ($realty->type) {
                    case Realty::APARTMENTS:
                        $model->title_en = Yii::t("RealtyModule.realty", 'Квартира') . ' - ' .
                            Yii::t("RealtyModule.realty",
                                '{n} комната|{n} комнаты|{n} комнат',
                                array($realtyDetailed->rooms, '{n}' => $realtyDetailed->rooms)
                            );
                        break;
                    case Realty::ESTATE:
                        $model->title_en = Yii::t("RealtyModule.realty", 'Дом') . ' - ' .
                            Yii::t("RealtyModule.realty",
                                '{n} спальня|{n} спальни|{n} спален',
                                array($realtyDetailed->bedrooms, '{n}' => $realtyDetailed->bedrooms)
                            );
                        break;
                    case Realty::LAND_POT:
                        $model->title_en = Yii::t("RealtyModule.realty", 'Участок') . ' - ' .
                            mb_strtolower($realtyDetailed->getLandType($realtyDetailed->type));
                        break;
                    case Realty::COMMERTIAL:
                        $model->title_en = Yii::t("RealtyModule.realty", 'Коммерческая площадь');
                        break;
                }
                Yii::app()->language = $curr_lang;
            }

            switch ($model->lng){
                case 'ru':
                    $model->scenario = 'ru';
                    $realty->addressStreet = $model->street_ru;
                    break;
                case 'ro':
                    $model->scenario = 'ro';
                    $realty->addressStreet = $model->street_ro;
                    break;
                case 'en':
                    $model->scenario = 'en';
                    $realty->addressStreet = $model->street_en;
                    break;
                default:
                    $model->scenario = 'ru';
                    $realty->addressStreet = $model->street_ru;
            }

            $transaction = Yii::app()->db->beginTransaction();

            try{
                if ($model->save()) {
                    $realty->save();

                    $transaction->commit();

                    $this->redirect(array('admin'));
                }
            }catch(Exception $e){
                $transaction->rollback();
                $this->redirect(array('admin'));
            }

        }
        $IsNew = false;
        $realtyTypeTags = RealtyTags::getTagsByRealtyTypeOrderByTitle($realty->type);
        $this->render('updateAd',array(
            'model' => $model,
            'realty' => $realty,
            'address'=>$address,
            'realtyDetailed' => $realtyDetailed,
            'videos'=>$videos,
            'existVideos'=>$existVideos,
            'IsNew' => $IsNew,
            'realtyTypeTags' => $realtyTypeTags,
        ));
    }

    public function actionDeleteVideo($id)
    {
        $video = RealtyOfferVideo::model()->findByPk($id);
        if($video->delete()){
            echo json_encode(array(
                'success'=>1,
                'id'=>$video->id
            ));
        }else{
            echo json_encode(array(
                'success'=>0,
                'error'=>$video->getErrors()
            ));
        }
        Yii::app()->end();
    }

    /**
     * Создать аукцион для объявления
     * @param $id
     */
    public function actionAuction($id)
    {
        $exist = Auction::model()->findByAttributes(array(
            'offer_id'=>$id,
            'status'=>1
        ));

        if($exist){
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $model = new Auction();
        $model->offer_id = $id;
        if($model->save()){
            $this->redirect(array('/backend/auction/update', 'id'=>$model->id));
        }else{
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    /**
     * Возвращает список объектов из реестра недвижимости
     */
    public function actionAjaxRealtyList()
    {
        $realty = new Realty();

        $realty->unsetAttributes();
        if (isset($_GET['Realty'])) {
            $realty->attributes=$_GET['Realty'];
        }

        $this->render('_ajaxRealtyList',array(
            'realty' => $realty,
        ));
    }

    public function createModel()
    {
        return new RealtyOffer();
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=RealtyOffer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
    public function performAjaxValidation($model)
	{
        if (isset($_POST['ajax']) && $_POST['ajax']==='blog-article-form')
        {
            $step = Yii::app()->request->getParam('step', null);

            $parameter = array();
            if (isset($_POST['OfferParameter'])) {
                foreach ($_POST['OfferParameter'] as $key => $value) {
                    $parameter[$key] = new OfferParameter($step);
                }
            }

            $f1 = json_decode(CActiveForm::validate($model), 1);
            $f2 = json_decode(CActiveForm::validateTabular($parameter), 1);
            $ret = json_encode(array_merge($f1, $f2));

            if (isset($_POST['step']) && $_POST['step'] == 'step1' && $ret == '[]') {
//                $this->cloneImage($model);
                $ret = '';
                $ret['type'] = 'image';
                $ret['content'] = $this->renderPartial('offer.views.realtyOffer._imagePack', array('model' => $model), true);
                $ret = json_encode($ret);
            }

            if (isset($_POST['step']) && $_POST['step'] == 'step3' && $ret == '[]') {
                $post = $_POST['RealtyOffer'];
                $ret = '';
                $ret['type'] = 'preview';

                $post = array_merge($post, $_POST['RealtyOfferVideo']);

                Yii::app()->session['post'] = $post;
                $ret['content'] = $this->renderPartial('offer.views.realtyOffer._preview', $post, true);
                $ret = json_encode($ret);
            }

            echo $ret;
            Yii::app()->end();
        }
	}

    /**
     * Валидация для формы создания объявления без реестра недвижимости
     * @param $model
     * @throws CException
     */
    public function performAjaxValidationAd($model)
    {
        if (Yii::app()->request->isAjaxRequest){
            if($_POST['ajax']==='ad-article-form'){

                $step = Yii::app()->request->getParam('step', null);

                $parameter = array();
                if (isset($_POST['OfferParameter'])) {
                    foreach ($_POST['OfferParameter'] as $key => $value) {
                        $parameter[$key] = new OfferParameter($step);
                    }
                }

                $f1 = json_decode(CActiveForm::validate($model), 1);
                $f2 = json_decode(CActiveForm::validateTabular($parameter), 1);
                $ret = json_encode(array_merge($f1, $f2));

                //Дополнительные параметры для заполнения объекта реестра недвижимости
                if (isset($_POST['step']) && $_POST['step'] == 'step1' && $ret == '[]') {
//                $this->cloneImage($model);
                    $ret = [];
                    $ret['type'] = 'image';
                    $ret['content'] = [];
                    $ret['content'] = $this->renderPartial('offer.views.realtyOffer._imagePack', array('model' => $model), true);
                    $ret = json_encode($ret);
                }

                if (isset($_POST['step']) && $_POST['step'] == 'ad_step2' && $ret == '[]') {
//                $this->cloneImage($model);
                    $ret = [];
                    $ret['type'] = 'image';
                    $ret['content'] = [];
                    $ret['content'] = $this->renderPartial('offer.views.realtyOffer._imagePack', array('model' => $model), true);
                    $ret = json_encode($ret);
                }

                //Возвращается json объект с предпросмотром объявления
                if (isset($_POST['step']) && $_POST['step'] == 'ad_step3' && $ret == '[]') {
                    $post = $_POST['RealtyOffer'];
                    $post['offer_type'] = $_POST['RealtyOffer']['type'];
                    $post = array_merge($post, $_POST['Realty'], $_POST['RealtyOfferVideo']);
                    $ret = [];
                    $ret['type'] = 'preview';
                    $ret['content'] = [];
                    Yii::app()->session['post'] = $post;
                    $ret['content'] = $this->renderPartial('offer.views.realtyOffer._preview_ad', $post, true);
                    $ret = json_encode($ret);
                }

                echo $ret;
            }
            Yii::app()->end();
        }
    }

    private function cloneImage($model) {
        if (!$model->isNewRecord && $model->realty_id == $_POST['RealtyOffer']['realty_id']) {
            return;
        }

        $realty = Realty::model()->findByPk($model->realty_id);
        if ($realtyImages = $realty->contypeImagesList) {
            foreach ($realtyImages as $image) {
                MultipleImages::model()->delete('content_type = :ct AND item_id = :id AND clone = 1', array(
                    ':ct' => 'realty_offer',
                    ':item_id' => $_POST['RealtyOffer']['realty_id'],
                ));
                $new = new MultipleImages();
                $new->attributes = $image->attributes;
                $new->content_type = $model->getClass();
                $new->item_id = $_POST['RealtyOffer']['temp_id'];
                $new->clone = 1;
                $new->id = null;
                $new->save();
            }
        }
    }

    public function actionCheckRealtyType() {
        if (Yii::app()->request->isAjaxRequest) {
            $ret = array(
                'address' => '',
                'area' => '',
            );
            $item_id = Yii::app()->request->getParam('item-id', null);
            $realty = Realty::model()->findByPk($item_id);

            $area = '';
            if ($realty) {
                if ($realty->realtyDetailed->total_space_size) {
                    $area = $realty->realtyDetailed->total_space_size.' '.$realty->realtyDetailed->space_size_units;
                } else {
                    $area = $realty->realtyDetailed->parcel_size.' '.$realty->realtyDetailed->parcel_size_unit;
                }

                $ret = array(
                    'address' => $realty->addressTable->search_string,
                    'area' => $area,
                    'description' => $realty->description,
                );
            }

            Yii::app()->ajax->success($ret);
        } else
            throw new CHttpException(400, Yii::t("base", 'Invalid request. Please do not repeat this request again.'));
    }

    public function actionAdditem()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $ret = array();
            $count = (int) $_GET['count'];

            if(!is_int($count)) throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.ba-bbq.js' => false,
            );

            $parameter = new OfferParameter();
            $ret['responce'] = $this->renderPartial('add',
                array(
                    'count' => $count,
                    'parameter' => $parameter
                ),
                true,
                false
            );

            Yii::app()->ajax->success($ret);
        }
    }

    public function actionChangeCity()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $ret = array();

            $city_id = (int) $_GET['city_id'];
//            $city_id = Yii::app()->request->getParam('city_id', null);
            $address = new RealtyAddress();
            $basecityId = 618426;
            if (!is_int($city_id)) throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.ba-bbq.js' => false,
            );
            if ($city_id==618427) {
                $district = RealtyAddress::model()->getDistrictSuburbs($basecityId);
            } else {
            $district = RealtyAddress::model()->getDistrict();
            }
            $ret['responce'] = $this->renderPartial('_district',
                array(
                    'address' => $address,
                    'district' => $district,
                ),
                true,
                false
            );
            echo json_encode($ret);
            Yii::app()->end();
        }
    }

    public function actionLotToggle() {
        if (Yii::app()->request->isPostRequest) {
            $id = Yii::app()->request->getQuery('id');
            $realtyOffer = RealtyOffer::model()->findByPk($id);
            if ($realtyOffer) {
                $realtyOffer->is_active = $realtyOffer->is_active ? 0 : 1;
                if ($realtyOffer->saveAttributes(array('is_active'))) {
                    Yii::app()->ajax->success();
                }
            }

            Yii::app()->ajax->failure();
        } else
            throw new CHttpException(400, Yii::t("base", 'Invalid request. Please do not repeat this request again.'));
    }

    public function actionLotToggleBulk()
    {
        if(isset($_POST['selectedIds'])){
            foreach ($_POST['selectedIds'] as $selectedId) {
                $realtyOffer = RealtyOffer::model()->findByPk($selectedId);
                if ($realtyOffer) {
                    $realtyOffer->is_active = $realtyOffer->is_active ? 0 : 1;
                    if ($realtyOffer->saveAttributes(array('is_active'))) {
                        Yii::app()->ajax->success();
                    }
                }
            }
        }
    }

    public function actionTree()
    {
        if (isset($_POST["ids"])) {
            $ids = $_POST["ids"];
            foreach ($ids as $key => $id) {
                $menu = MultipleImages::model()->findByPk((int)$id);
                if (isset($menu->flash_messages)) {
                    $menu->flash_messages = false;
                }

                if ($menu && (int)$id != 0) {
                    $menu->priority = $key;
                    $menu->save();
                }
            }
            echo json_encode($ids);
        }
    }

    public function actionAddDetailDescription()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $ret = array();
            $type = Yii::app()->request->getParam('type', null);
            $realty_id = Yii::app()->request->getParam('realty_id', null);

            if (!$type) {
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }

            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.ba-bbq.js' => false,
            );

            $realtyDetailed = new RealtyDetailedDescription($type);
            if ($realty_id) {
                if ($realty = Realty::model()->findByPk($realty_id)) {
                    $realtyDetailed_exist = $realty->realtyDetailed;
                    if ($realtyDetailed_exist) {
                        $realtyDetailed = $realtyDetailed_exist;
                        $realtyDetailed->type = $type;
                    }
                }
            }

            $realtyTypeTags = RealtyTags::getTagsByRealtyTypeOrderByTitle($type);

            $ret['responce'] = $this->renderPartial(
                'detail_information/'.$type,
                array('realtyDetailed' => $realtyDetailed),
                true,
                false
            );
            $ret['responce_tags'] = $this->renderPartial(
                'detail_information/_realty_tags',
                ['realtyTypeTags' => $realtyTypeTags, 'realty' => $realty],
                true,
                false
            );

            echo json_encode($ret);
            Yii::app()->end();
        }
    }

}