<?php
include ('Config_Vars.php');
// global directory ftp (related from this file)
Yii::setPathOfAlias('global',realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'../../../'));
// directory of project where live common directory
Yii::setPathOfAlias('mainproject',Yii::getPathOfAlias('global').'/'.$main_site);
// common directory for all
Yii::setPathOfAlias('common',Yii::getPathOfAlias('mainproject.protected.common'));

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

include ('Config_Modules.php');
include ('Config_DB.php');
include ('Config_Log.php');
include ('Config_User.php');
include ('Config_Cache.php');

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Socio',
    'charset'=>'utf-8',

    // Application default language.
    'language' => 'ru',
    'sourceLanguage' => 'en',

    // preloading 'log' component
    'preload'=>array(
        'log',
        // Twitter bootstrap setup.
        'bootstrap',
    ),

    // autoloading model and component classes
    'import'=>array(
	      'common.models.*',
	      'common.models.dostup.*',

        'application.models.*',
        'application.components.*',
        'application.controllers.*',
        'application.extensions.*',
        'application.extensions.widgets.*',
        'application.helpers.*',

        'ext.yii-mail.YiiMailMessage',
        'ext.yiiext.filters.setReturnUrl.ESetReturnUrlFilter',
    ),

        'modules'=>$conf_modules,

    // application components
    'components'=>array(
        'user' => $component_user,
        'db' => $conf_db,
        'log' => $conf_log,
        'cache' => $conf_cache,

        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName' => false,
                'rules'=>array(
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
       ),

        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

        // Twitter bootstrap setup.
        'bootstrap'=>array(
            'class'=>'ext.bootstrap.components.Bootstrap',
            'responsiveCss'=>true,
        ),
    ),

/*
		'controllerMap'=>array(
			'gotme'=>array(
				'class'=>'common.controllers.GotmeController',
				'viewPath'=>'common.views.gotme', //now
			),
		),
*/

	// application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'admin@socinfo.net.ua',
	    'dbname'=>'socio',
    ),
);
