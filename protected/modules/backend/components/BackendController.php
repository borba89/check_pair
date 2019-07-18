<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

class BackendController extends Controller
{
    public $sidebar_tab;
    public $title;
    public $multiaplodImages;

    public $icon;
    public $tabTitle;
    public $menuModel;
    public $activeAddress;

    public function init()
    {
        $this->layout = Yii::app()->getModule('backend')->getBackendLayoutAlias('layout_panel');
        if (!empty($this->sidebar_tab))
            Yii::app()->session["sidebar_tab"] = $this->sidebar_tab;
        parent::init();
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function showClip($clip_id) {
        $all_clips = $this->getClips();

        if (isset($all_clips[$clip_id]))
            echo $all_clips[$clip_id];
    }

    public function actionAjaxTags()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (isset($_GET['q'])){
                $tags = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('tags')
                    ->where("tag LIKE :search", array(':search' => '%'.$_GET['q'].'%'))
                    ->limit(15)
                    ->queryAll();
                $returnArr = array();
                foreach($tags as $value) {
                    $returnArr[] = array('id' => $value['id'], 'text' => $value['tag']);
                }
                echo json_encode(array('results' => $returnArr));
            }
            Yii::app()->end();
        }
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('upload', 'gallery','logout','login','error', 'additem', 'removeadd', 'changeCity'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(
                    'send',
                    'index',
                    'tree',
                    'view',
                    'create',
                    'createAd',
                    'update',
                    'updateAd',
                    'delete',
                    'admin',
                    'map',
                    'imagedel',
                    'updatepassword',
                    'search',
                    'adminStaff',
                    'adminMembers',
                    'ajaxTags',
                    'titleUpdate',
                    'mainimage',
                    'related',
                    'add',
                    'widget',
                    'statusUpdate',
                    'sort',
                    'excel',
                    'blockSearch',
                    'category',
                    'quantityUpdate',
                    'ajaxSearch',
                    'updateItemGroup',
                    'deleteContentType',
                    'updateAttribute',
                    'exportCsv',
                    'citySearch',
                    'cityDistrictSearch',
                    'addDetailDescription',
                    'lotToggle',
                    'suggest',
                    'checkRealtyType',
                    'ajaxRealtyList',
                    'tree',
                    'deleteVideo',
                    'mail',
                    'pages',
                    'company',
                    'about',
                    'propertyList',
                    'propertySingle',
                    'vacancy',
                    'contact',
                    'edit',
                    'toggle',
                    'blog',
                    'approve',
                    'auction',
                    'preview',
                    'lotToggleBulk',
                ),
                'expression'=>'Yii::app()->user->isBackend',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
}