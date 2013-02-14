<?php

class OrganizationController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/organization';

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
                'actions'=>array('index','view','search'),
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // Escalate organization for view.
        $this->escalateOrganization($model);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Organization;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Organization']))
        {
            $model->attributes=$_POST['Organization'];

            // Relations.
            $model->type = isset($_POST['Organization']['type']) ? Orgtype::model()->findByPk($model->type) : null;
            // Upload handler.
            $model->logo = CUploadedFile::getInstance($model, 'logo');
            // Empty multi select handler.
            $model->directions = isset($_POST['Organization']['directions']) ? $model->directions : array();
            $model->problems = isset($_POST['Organization']['problems']) ? $model->problems : array();

            if($model->save())
                $this->redirect(array('update','id'=>$model->id));
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
        /** @var $model Organization */
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Organization']))
        {
            $model->attributes=$_POST['Organization'];

            // Relations.
            $model->type = isset($_POST['Organization']['type']) ? Orgtype::model()->findByPk($model->type) : null;
            // Upload handler.
            $model->logo = CUploadedFile::getInstance($model, 'logo');
            // Empty multi select handler.
            $model->directions = isset($_POST['Organization']['directions']) ? $model->directions : array();
            $model->problems = isset($_POST['Organization']['problems']) ? $model->problems : array();

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        // Escalate organization for view.
        $this->escalateOrganization($model);

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * main page of organizations.
     */
    public function actionIndex()
    {
        $this->render('main',array(
    ));

        // $dataProvider=new CActiveDataProvider('Organization');
        // $this->render('index',array(
        //     'dataProvider'=>$dataProvider,
        // ));
    }


    /**
     * Lists all models.
     */
    public function actionSearch()
    {
        $model=new Organization('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Organization'])) {
            $model->attributes=$_GET['Organization'];

            // // Relations.
            // $model->type = isset($_GET['Organization']['type']) ? Orgtype::model()->findByPk($model->type) : null;
            // $model->directions = isset($_GET['Organization']['directions']) ? Direction::model()->findAllByPk($model->directions) : array();
            // $model->problems = isset($_GET['Organization']['problems']) ? Problem::model()->findAllByPk($model->problems) : array();
        }

        $this->render('index',array(
            'model'=>$model,
        ));

        // $dataProvider=new CActiveDataProvider('Organization');
        // $this->render('index',array(
        //     'dataProvider'=>$dataProvider,
        // ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Organization('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Organization']))
            $model->attributes=$_GET['Organization'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * AJAX model manipulation from administrator panel.
     */
    public function actionDynamicAdminUpdate()
    {
        Yii::import('bootstrap.widgets.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('Organization'); // 'User' is classname of model to be updated
        $es->update();

//
//         if (!isset($_POST['id'])) {
//             return;
//         }
//
//         $model = $this->loadModel($_POST['id']);
//
//         // Set all administrator fields to model.
//         if (isset($_POST['status'])) {
//             $model->status = $_POST['status'];
//         }
//         if (isset($_POST['verified'])) {
//             $model->verified = $_POST['verified'] === 'true' ? true: false;
//         }
//
//         $model->save();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Organization
     * @throws CHttpException
     **/
    public function loadModel($id)
    {
        $model=Organization::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel $model the model to be validated
     */
    public function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='organization-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
