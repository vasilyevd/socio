<?php

class CatorganizationController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column1';

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
                'actions'=>array('index','view', 'search'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin', 'dynamicAdminUpdate', 'delete'),
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
            'view' => 'application.components.actions.ViewAction',
            // 'create' => 'application.components.actions.CreateAction',
            // 'update' => 'application.components.actions.UpdateAction',
            'delete' => 'application.components.actions.DeleteAction',
            'index' => 'application.components.actions.SearchIndexAction',
            'admin' => 'application.components.actions.AdminAction',
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Catorganization;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Catorganization']))
        {
            $model->attributes=$_POST['Catorganization'];
            // Upload handler.
            $model->logo = CUploadedFile::getInstance($model, 'logo');
            // Empty multi select handler.
            $model->directions = isset($_POST['Catorganization']['directions']) ? $model->directions : array();

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Catorganization']))
        {
            $model->attributes=$_POST['Catorganization'];
            // Upload handler.
            $model->logo = CUploadedFile::getInstance($model, 'logo');
            // Empty multi select handler.
            $model->directions = isset($_POST['Catorganization']['directions']) ? $model->directions : array();

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Search filters for models.
     */
    public function actionSearch()
    {
        $model = new Catorganization('search');
        // Clear any default values.
        $model->unsetAttributes();

        if(isset($_GET['Catorganization'])) {
            $model->attributes = $_GET['Catorganization'];
        }

        $this->render('search', array(
            'model' => $model,
        ));
    }

    /**
     * AJAX model manipulation from administrator panel.
     */
    public function actionDynamicAdminUpdate()
    {
        // Or you can add import 'ext.editable.*' to config.
        Yii::import('bootstrap.widgets.TbEditableSaver');
        // 'User' is classname of model to be updated
        $es = new TbEditableSaver('Catorganization');
        $es->update();
    }
}
