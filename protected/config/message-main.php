<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'sourcePath' => __DIR__.'/..',
    'messagePath' => __DIR__.'/../messages',
    'languages' => array('ro', 'ru', 'en'),
    'fileTypes' => array('php'),
    'exclude' => array(),
    'translator' => 'Yii::t',
    'removeOld' => true,
    'sort' => true,
);