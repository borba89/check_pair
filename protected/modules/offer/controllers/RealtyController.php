<?php
Yii::import('backend.components.BackendController');
Yii::import('backend.components.multiapload.*');

class RealtyController extends BackendController
{
    public $sidebar_tab = "realty";

    public function actions()
    {
        return array(
            'upload' => 'UploadAction',
            'gallery'=>'GalleryAction',
            'imagedel'=>'ImagedelAction',
            'mainimage'=>'MainimageAction',

            'admin'=>'DAdminAction',
            'view' => 'DViewAction',
            'create'=> array(
                'class' => 'DCreateAction',
            ),
            'delete' => 'DDeleteAction',
            'update'=> array(
                'class' => 'DUpdateAction',
            ),
        );
    }

    public function actionCreate()
    {
        $model = $this->createModel();
        $step = Yii::app()->request->getParam('step', null);
        $model->scenario = $step;

        if ($model->address) {
            $address = $model->address;
        } else {
            $address = new RealtyAddress();
        }

        if ($model->realtyDetailed) {
            $realtyDetailed = $model->realtyDetailed;
        } else {
            $realtyDetailed = new RealtyDetailedDescription();
        }

        $this->performAjaxValidation($model);

        if (isset($_POST['Realty'])) {
            $model->attributes = $_POST['Realty'];
            $model->created = date('Y-m-d');

            if ($model->save()) {
                $this->redirect(['admin']);
            }
        }

        $this->render('create',array(
            'model'=>$model,
            'address' => $address,
            'realtyDetailed' => $realtyDetailed,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $step = Yii::app()->request->getParam('step', null);
        $model->scenario = $step;

        if ($addressTable = $model->addressTable) {
            $address = $addressTable;
        } else {
            $address = new RealtyAddress();
        }

        if ($realtyDetailed = $model->realtyDetailed) {
            $realtyDetailed = $realtyDetailed;
        } else {
            $realtyDetailed = new RealtyDetailedDescription();
        }

        $this->performAjaxValidation($model);

        if (isset($_POST['Realty'])) {
            $model->attributes = $_POST['Realty'];

            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('update',array(
            'model'=>$model,
            'address' => $address,
            'realtyDetailed' => $realtyDetailed,
        ));
    }

    public function createModel()
    {
        $step = Yii::app()->request->getParam('step', null);
        if ($step) {
            return new Realty($step);
        } else {
            return new Realty();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param $id
     * @return array|mixed|null
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Realty::model()->findByPk($id);

        if ($step = Yii::app()->request->getParam('step', null)) {
            $model->scenario = $step;
        }

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
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'blog-article-form') {
            $step = Yii::app()->request->getParam('step', null);

            $address = array();
            if (isset($_POST['RealtyAddress'])) {
                $address = new RealtyAddress($step);
            }

            if (isset($_POST['RealtyAddress'])) {
                $scenario = $_POST['Realty']['type'];
                $realtyDetailedDescription = new RealtyDetailedDescription($scenario.'_'.$step);
            }

            $f1 = json_decode(CActiveForm::validate($model), 1);
            $f2 = json_decode(CActiveForm::validate($address), 1);
            $f3 = json_decode(CActiveForm::validate($realtyDetailedDescription), 1);
            $ret = json_encode(array_merge($f1, $f2, $f3));

            if (isset($_POST['step']) && $_POST['step'] == 'step2' && $ret == '[]') {
                $ret = array();
                $post = $_POST['Realty'];
                $address = $_POST['RealtyAddress'];
                $detailedDescription = $_POST['RealtyDetailedDescription'];

                $post = array_merge($post, $address, $detailedDescription);
                $ret['type'] = 'preview';
                $ret['content'] = $this->renderPartial('realty.views.realty._preview', $post, true);
                $ret = json_encode($ret);
            }

            echo $ret;
            Yii::app()->end();
        }
    }

    public function actionCitySearch()
    {
        $country = Yii::app()->getRequest()->getPost('country', false);

        $criteria = new CDbCriteria;
        $criteria->condition = 'geonameid = :city_id';
        if ($country) {
            $criteria->addCondition("country = :country");
            $criteria->params[':country'] = $country;
        }

        $criteria->params[':city_id'] = 618426;
        $criteria->limit = 100;
        $cities = City::model()->findAll($criteria);

        $data = [];
        foreach ($cities as $city) {
            $data[] = [
                'id' => $city->geonameid,
                'name' => $city->getCityName(),
            ];
        }

        Yii::app()->ajax->raw($data);
    }

    public function actionCityDistrictSearch()
    {
        $city = Yii::app()->getRequest()->getPost('city', false);

        $criteria = new CDbCriteria;
        if ($city) {
            $criteria->addCondition("city_id = :city");
            $criteria->params[':city'] = $city;
        }

        $districts = CityDistrict::model()->findAll($criteria);

        $data = [];
        foreach ($districts as $district) {
            $data[] = [
                'id' => $district->id,
                'name' => $district->district,
            ];
        }

        Yii::app()->ajax->raw($data);
    }

    public function actionAddDetailDescription()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $ret = array();
            $type = Yii::app()->request->getParam('type', null);

            if (!$type) {
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }

            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.ba-bbq.js' => false,
            );

            $realtyDetailed = new RealtyDetailedDescription($type);
            $ret['responce'] = $this->renderPartial(
                'detail_information/'.$type,
                array('realtyDetailed' => $realtyDetailed),
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
            $realty = Realty::model()->findByPk($id);
            if ($realty) {
                $realty->status = ($realty->status == Realty::OPENED)
                    ? Realty::CLOSED : Realty::OPENED;
                if ($realty->saveAttributes(array('status'))) {
                    Yii::app()->ajax->success();
                }
            }

            Yii::app()->ajax->failure();
        } else
            throw new CHttpException(400, Yii::t("base", 'Invalid request. Please do not repeat this request again.'));
    }

    public function actionSuggest() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $criteria = new CDbCriteria;
            $criteria->compare('search_string', $_GET['term'], true);
            $models = RealtyAddress::model()->findAll($criteria);
            $result = array();
            if ($models) {
                foreach ($models as $m) {
                    $result[$m->search_string] = null;
                }
            }

            echo Yii::app()->ajax->raw($result);
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
}
