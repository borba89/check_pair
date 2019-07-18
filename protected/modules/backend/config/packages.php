<?php
/**
 * Cybtronix
 * Date: 16/01/19
 * Time: 22:00 PM
 */

return array(
    'backendbase' => array(
        'baseUrl' => $this->assetsUrl,
        'css' => array(
            'plugins/materialize/css/materialize.min.css',
            'plugins/metrojs/MetroJs.min.css',
            'plugins/weather-icons-master/css/weather-icons.min.css',
            'css/alpha.min.css',
            'css/custom.css',
        ),
        'js' => array(
            'js/jqueryui-1.10.3.min.js',
            'plugins/materialize/js/materialize.min.js',
//            'plugins/materialize/js/materialize.js',
            'plugins/material-preloader/js/materialPreloader.min.js',
            'plugins/jquery-blockui/jquery.blockui.js',
            'plugins/waypoints/jquery.waypoints.min.js',
            'plugins/counter-up-master/jquery.counterup.min.js',
            'plugins/peity/jquery.peity.min.js',
            'plugins/jquery-steps/jquery.steps.min.js',
            'js/alpha.min.js',
            'js/pages/form-wizard.js',
            //'js/pages/ad-form-wizard.js',
            'js/custom.js',
            'js/jquery.ui.nestedSortable.js',
            'js/jquery.mjs.nestedSortable.js',
//            'js/bootstrap.min.js',
        ),
        'depends' => array('jquery'),
    ),

    'login' => array(
        'baseUrl' => $this->assetsUrl,
        'css' => array(
            'plugins/materialize/css/materialize.min.css',
            'plugins/material-preloader/css/materialPreloader.min.css',
            'css/alpha.min.css',
            'css/custom.css',
        ),
        'js' => array(
            'plugins/materialize/js/materialize.min.js',
            'plugins/material-preloader/js/materialPreloader.min.js',
            'plugins/jquery-blockui/jquery.blockui.js',
            'js/alpha.min.js',
        ),
        'depends' => array('jquery'),
    ),
);
