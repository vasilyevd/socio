<?php

class AnnouncementController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/announcement';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete, dynamicDeleteFile', // we only allow deletion via POST request
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
                'actions'=>array('index', 'news', 'view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update', 'dynamicDeleteFile'),
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // Escalate organization for view.
        $this->escalateOrganization($model->organization);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $org the ID of the parent organization.
     */
    public function actionCreate($org)
    {
        //TODO: if org valid for current user. IN RULES?

        $model=new Announcement;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Announcement']))
        {
            $model->attributes=$_POST['Announcement'];

            // Relations.
            $model->organization = $org;

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        // Escalate organization for view.
        $this->escalateOrganization($org);

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

        if(isset($_POST['Announcement']))
        {
            $model->attributes=$_POST['Announcement'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        // Escalate organization for view.
        $this->escalateOrganization($model->organization);

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
        // $this->loadModel($id)->delete();

        // // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        // if(!isset($_GET['ajax']))
        //     $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

        $model = $this->loadModel($id);
        $model->delete();
        if(!isset($_GET['ajax']))
            $this->redirect(array('index','org' => $model->organization_id));
    }

    /**
     * Lists all models.
     * @param integer $org the ID of the organization model.
     */
    public function actionIndex($org)
    {
        // $dataProvider=new CActiveDataProvider('Announcement');
        // $this->render('index',array(
        //     'dataProvider'=>$dataProvider,
        // ));

        $model=new Announcement('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Announcement']))
            $model->attributes=$_GET['Announcement'];

        // Limit search to only this organization.
        $model->organization = $org;

        // Escalate organization for view.
        $this->escalateOrganization($org);

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    /**
     * Lists only big announcements (news) models.
     * @param integer $org the ID of the organization model.
     */
    public function actionNews($org)
    {
        $model=new Announcement('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Announcement']))
            $model->attributes=$_GET['Announcement'];

        // Limit search to only this organization.
        $model->organization = $org;

        // Escalate organization for view.
        $this->escalateOrganization($org);

        $this->render('news',array(
            'model'=>$model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Announcement('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Announcement']))
            $model->attributes=$_GET['Announcement'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Upload handler.
     * AJAX delete of particular uploaded file.
     */
    public function actionDynamicDeleteFile($id)
    {
        $model=Annfile::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        $model->delete();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Announcement::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='announcement-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
