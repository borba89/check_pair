<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$dirs = scandir(dirname(__FILE__).'/../modules');
$configDir = dirname(__FILE__);

// строим массив модулей
$modules = array();
foreach ($dirs as $name){
    if ($name[0] != '.')
        $modules[$name] = array();
}

define('MODULES_MATCHES', implode('|', array_keys($modules)));

$mainLocalFile = $configDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile) ? require($mainLocalFile) : array();

$mainEnvFile = $configDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
    array(
        'language' => 'ru',
        'sourceLanguage'=>'ru',
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'New Door Realty',

        // preloading 'log' component
        'preload'=>array('log'),

        // autoloading model and component classes
        'import'=>array(
            'ext.mailer.Emailer',
            'application.models.*',
            'application.components.*',
            'application.widget.*',
            'application.components.helpers.*',
            'application.extensions.*',
            'application.modules.yiiseo.models.*',
            'application.helpers.*',
            'application.components.CImageHandler',
            'application.modules.backend.models.*',
            'application.modules.menu.models.*',
            'application.modules.menu.components.*',
        ),

        'modules'=>array_replace($modules, array(
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'12345',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'=>array('127.0.0.1','::1'),
                'generatorPaths'=>array(
                    'booster.gii',
                ),
            ),
            'yiiseo' => array(
                'class' => 'application.modules.yiiseo.YiiseoModule',
                'password' => 'admin12345',
            ),
            'comments'=>array(
                //Вы можете переопределить конфигурацию по умолчанию для всех моделей подключения
                'defaultModelConfig' => array(
                    //Только зарегистрированные пользователи могут оставлять комментарии
                    'registeredOnly' => false,
                    'useCaptcha' => true,
                    //разрешить дерево комментариев
                    'allowSubcommenting' => true,
                    //Показывать форму во всплывающем окне
                    'showPopupForm'=>false,
                    //отображать комментарии после модерации
                    'premoderate' => false,
                    //действие для публикации комментария
                    'postCommentAction' => 'comments/comment/postComment',
                    //условие супер пользователя (отображение списка комментариев в режиме администратора и автоматическое изменение комментариев)
                    'isSuperuser'=>'Yii::app()->user->isAdmin',
                    //направление сортировки для комментариев
                    'orderComments'=>'DESC',
                ),
                //модели для комментирования
                'commentableModels'=>array(
                    //модель с настройками по умолчанию
                    'BlogArticle',
                ),
                //конфиг для пользовательских моделей, который используется в приложении
                'userConfig'=>array(
                    'class'=>'User',
                    'nameProperty'=>'name',
                    //'emailProperty'=>'email',
                ),
            ),
        )),
        //TODO: зазобраться с behaviors что и когда подключается
        'behaviors'=> array(
            array(
                'class'=>'backend.components.behavior.ModuleUrlRulesBehavior',
                'beforeCurrentModule'=>array(
                    'main',
                    'backend',
                    'realty',
                ),
            ),
//            'onbeginRequest'=>array('class'=>'application.components.StartupBehavior'),
        ),

        // application components
        'components'=>array(
            'widgetFactory' => array(
                'enableSkin' => true,
                'skinPath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'skins',
            ),

            'seo' => array(
                'class' => 'application.modules.yiiseo.components.SeoExt',
            ),

            'booster' => array(
                'class' => 'ext.booster.components.Booster',
                'forceCopyAssets' => false,
                'fontAwesomeCss' => true,
                'enableJS' => true,
                'coreCss' => true,
            ),

            'format' => array(
                'class' => 'backend.components.ExtendedFormatter'
            ),

            'languages' => array(
                'class' => 'Languages',
                'useLanguage' => true,
                'autoDetect' => true,
                'defaultLanguage' => 'ru',
                'languages' => array('ru', 'ro', 'en'), //'en','ro',
            ),

            'iwi' => array(
                'class' => 'application.extensions.iwi.IwiComponent',
                // GD or ImageMagick
                'driver' => 'GD',
                // ImageMagick setup path
                //'params'=>array('directory'=>'C:/ImageMagick'),
            ),

            'clientScript' => array(
                'coreScriptPosition' => CClientScript::POS_END,
            ),

            'assetManager' => array(
                'newDirMode' => 0755,
                'newFileMode' => 0655
            ),

            'user' => array(
                'allowAutoLogin'=>true,
                'class' => 'WebUser',
            ),

            'cache'=>array(
                'class'=>'system.caching.CFileCache',
            ),

            'email' => array(
                'class' => 'application.components.Email',
                'pathLayout'=>'webroot.themes.cybtronix.views.main.layouts.email',
                'method'=>'mail',//"mail", "sendmail", or "smtp".
                'smtpHost'=>'smtp.gmail.com',
                'smtpUsername'=>'lexeosimobil.mailer@gmail.com',
                'smtpPassword'=>'best-realty-offer',
                'smtpPort'=>587,//'465',
                'smtpSecure'=>'tls',
                'SMTPOptions'=>array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                ),
            ),

            'errorHandler' => array(
                'errorAction' => '/main/default/error',
            ),

            'image'=>array(
                'class'=>'application.extensions.image.CImageComponent',
                // GD or ImageMagick
                'driver'=>'GD',
                // ImageMagick setup path
                //'params'=>array('directory'=>'/opt/local/bin'),
            ),
            'ih'=>array(
                'class'=>'CImageHandler',
            ),
            // uncomment the following to enable URLs in path-format

            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,
                'rules'=>array(
                    'gii'=>'gii',
                    ''=>'main/default/index',
                    'backend'=>'backend/default/index',
                    '<module:' . MODULES_MATCHES . '>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                    '<module:' . MODULES_MATCHES . '>/<controller:\w+>/<action:\w+>/<id:\w+>'=>'<module>/<controller>/<action>',
                    '<module:' . MODULES_MATCHES . '>/<controller:\w+>'=>'<module>/<controller>/index',
                    '<module:' . MODULES_MATCHES . '>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),

            'session' => array('cookieParams' => array('httponly' => true)),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error',
                        //'levels'=>'error, warning, info, trace, profile',
                    ),
                    /*array(
                        'class'=>'CWebLogRoute',
                        'categories' => 'application',
                        'levels'=>'error, warning, trace, profile, info',
                    ),
                    array(
                        // направляем результаты профайлинга в ProfileLogRoute (отображается
                        // внизу страницы)
                        'class'=>'CProfileLogRoute',
                        'levels'=>'profile',
                        'enabled'=>true,
                    ),*/
                    array(
                        'class'=>'CFileLogRoute',
                        'logFile'=>'webhook_trace.log',
                        'levels'=>'error, warning, info, trace, profile',
                        'categories'=>'webhook.*',
                    ),
                ),
            ),
            'settings'=>array(
                'class'     	        => 'CmsSettings',
                'cacheComponentId'	=> 'cache',
                'cacheId'   		=> 'global_website_settings',
                'cacheTime' 		=> 84000,
                'tableName'		=> 'settings',
                'dbComponentId'		=> 'db',
                'createTable'		=> true,
                'dbEngine'		=> 'InnoDB',
            ),
            'recently'=>array(
                'class'=>'application.components.Recently',
            ),
            'ePdf' => array(
                'class'         => 'ext.yii-pdf.EYiiPdf',
                'params'        => array(
                    'mpdf'     => array(
                        'librarySourcePath' => 'application.vendor.mpdf.mpdf.src.*',
                        'constants'         => array(
                            '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                        ),
                        'class'=>'Mpdf', // the literal class filename to be loaded from the vendors folder
                    ),
                ),
            ),
            'metadata' => array('class' => 'Metadata'),
            'reCaptcha' => array(
                'name' => 'reCaptcha',
                'class' => 'ext.yiiReCaptcha.ReCaptcha',
                'key' => '6LfF7JYUAAAAAAD1YWbMwAqU28FausJG03exLA0h',
                'secret' => '6LfF7JYUAAAAAEcDi3WfcQOu_u5yt4rROFC4eKiE',
            ),
            /*'mustache'=>array(
                'class'=>'ext.mustache.components.MustacheApplicationComponent',
                // Default settings (not needed)
                'templatePathAlias'=>'',
                'templateExtension'=>'',
                'extension'=>false,
            ),*/
        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'=>array(
            'landing' => 1,
            'adminEmail'=>'oleg.buian@gmail.com',//'apodobulkin@yahoo.com',
            'no-replyEmail'=>'no-reply@'.$_SERVER['SERVER_NAME'],
            'itemsOffersPerPage' => 9,
            'noImage' => 'images/profile-no-photo.png',
            'cacheTime' => 3600,
            'googleMapKey' => 'AIzaSyDJVbJ6Hx1ujltysxHUZw0PXUakYihUcKA',
            'itemsPerPage' => 20,
            'frontend_theme' => 'cybtronix',
        ),
    ),
    CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);
