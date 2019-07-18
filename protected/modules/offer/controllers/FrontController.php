<?php
Yii::import('main.components.Frontend');

class FrontController extends Frontend
{
    public $apiClass;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index', 'single', 'add', 'favorite', 'preview', 'previewAd', 'sale', 'reset'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    protected function beforeAction($action)
    {
        $this->apiClass = Yii::createComponent('offer.models.ApiOffer');
        return parent::beforeAction($action);
    }

    /**
     * Reset action
     */
    public function actionReset()
    {
        unset(Yii::app()->session['areaFilter']);
        unset(Yii::app()->session['districts']);
        unset(Yii::app()->session['moneyFilter']);
        unset(Yii::app()->session['realtyOffer']);
        unset(Yii::app()->session['realtyType']);

        $this->redirect(array('index'));
    }

    /**
     * @param null $param
     */
    public function actionIndex($param = null)
    {
        $this->footer_filter = true;
        $this->footer_favorite = true;
        if (!Yii::app()->request->isAjaxRequest) {
            $_POST['realtyOffer'][] = RealtyOffer::RENT;
            $_POST['realtyType'][] = Realty::LAND_POT;

            if (in_array($param, array(RealtyOffer::SALE, RealtyOffer::RENT))) {
                $_POST['realtyOffer'][] = $param;
            }
        }

        if (!empty($_POST['areaFilter'])
            && !empty($_POST['districts'])
            && !empty($_POST['moneyFilter'])
            && !empty($_POST['realtyOffer'])
            && !empty($_POST['realtyType'])
        ) {
            Yii::app()->session['areaFilter'] = $_POST['areaFilter'];
            Yii::app()->session['districts'] = $_POST['districts'];
            Yii::app()->session['moneyFilter'] = $_POST['moneyFilter'];
            Yii::app()->session['realtyOffer'] = $_POST['realtyOffer'];
            Yii::app()->session['realtyType'] = $_POST['realtyType'];
        } elseif (
            isset(Yii::app()->session['areaFilter'])
            && isset(Yii::app()->session['districts'])
            && isset(Yii::app()->session['moneyFilter'])
            && isset(Yii::app()->session['realtyOffer'])
            && isset(Yii::app()->session['realtyType'])
        ) {
            $_POST['areaFilter'] = Yii::app()->session['areaFilter'];
            $_POST['districts'] = Yii::app()->session['districts'];
            $_POST['moneyFilter'] = Yii::app()->session['moneyFilter'];
            $_POST['realtyOffer'] = Yii::app()->session['realtyOffer'];
            $_POST['realtyType'] = Yii::app()->session['realtyType'];
        }

        $realtyOffers = $this->apiClass->getOffers();
        $this->render('index', array('realtyOffers' => $realtyOffers));
    }

    public function actionSale()
    {
        $this->footer_filter = true;
        $this->footer_favorite = true;

        if (!Yii::app()->request->isAjaxRequest) {
            $_POST['realtyOffer'][] = RealtyOffer::SALE;
            $_POST['realtyType'][] = Realty::LAND_POT;
        }

        $realtyOffers = $this->apiClass->getOffers();
        $this->render('index', array('realtyOffers' => $realtyOffers));
    }

    public function actionFavorite()
    {
        $this->footer_phone = true;
        $realtyOffers = $this->apiClass->getFavorite();
        $this->render('index', array('realtyOffers' => $realtyOffers));
    }

    public function actionSingle($id)
    {
        $this->footer_phone = true;
        $realtyOffer = $this->apiClass->getOffer($id);

        if (!$realtyOffer) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        /**
         * Запомнить просмотренное объявление
         */
        Yii::app()->recently->setProperty($realtyOffer->id);

        $this->render('single', array('realtyOffer' => $realtyOffer));
    }

    public function actionPreview()
    {
        $post = Yii::app()->session['post'];

        if (!$post) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        $this->render('preview', array('post' => $post));
    }

    public function actionPreviewAd()
    {
        $post = Yii::app()->session['post'];

        if (!$post) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        //echo CVarDumper::dump($post, 10, true);exit;
        $this->render('preview_without_realty', array('post' => $post));
    }

    public function actionAdd()
    {
        if (!Yii::app()->getRequest()->getIsPostRequest()) {
            throw new CHttpException(404);
        }

        $product = Yii::app()->getRequest()->getPost('Product');

        if (empty($product['id'])) {
            throw new CHttpException(404);
        }

        $model = RealtyOffer::model()->findByPk($product['id']);

        if (null === $model) {
            throw new CHttpException(404);
        }

        $fav = Favorite::model()->findByAttributes(array(
            'user_ip' => YHelper::get_client_ip(),
            'offer_id' => $model->id
        ));

        if (!$fav) {
            $fav = new Favorite();
            $fav->user_ip = YHelper::get_client_ip();
            $fav->offer_id = $model->id;
            if ($fav->save()) {
                $model->saveCounters(array('add_favorite_'.Yii::app()->language => 1));
                Yii::app()->ajax->success(array(
                    'count'=>$fav->getTotalFav(),
                    'src'=>Yii::app()->getModule('main')->themeAssets.'/img/star-hover-big.png',
                    'label'=>Yii::t('MainModule.main', 'Удалить из избранного')
                ));
            }
        } else {
            if ($fav->delete()) {
                $model->saveCounters(array('remove_favorite'=>1));
                Yii::app()->ajax->success(array(
                    'count'=>$fav->getTotalFav(),
                    'src'=>Yii::app()->getModule('main')->themeAssets.'/img/star-normal-big.png',
                    'label'=>Yii::t('MainModule.main', 'Добавить в избранное')
                ));
            }
        }
    }
}