<?php

class DonorshipController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/potential';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create', 'update'),
                'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // General CRUD actions.
            'view' => 'application.components.actions.OrgViewAction',
            'create' => 'application.components.actions.OrgCreateAction',
            'update' => 'application.components.actions.OrgUpdateAction',
            'delete' => 'application.components.actions.OrgDeleteAction',
            'index' => 'application.components.actions.OrgIndexAction',
            'admin' => 'application.components.actions.AdminAction',
        );
    }
}
