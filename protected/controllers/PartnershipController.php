<?php

class PartnershipController extends Controller
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
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create', 'update', 'updateVerification', 'dynamicDeleteFile'),
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
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $org the ID of the organization model.
     */
    public function actionCreate($org)
    {
        $model=new Partnership;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Partnership']))
        {
            $model->attributes=$_POST['Partnership'];

            // Relations.
            $model->organization = $org;

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        // Empty 'linkOrganization', relation for view.
        $model->linkOrganization = null;

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

        if(isset($_POST['Partnership']))
        {
            $model->attributes=$_POST['Partnership'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        // Empty 'linkOrganization', relation for view.
        $model->linkOrganization = null;

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateVerification($id)
    {
        $model=$this->loadModel($id);

        // Custom scenario.
        $model->scenario = 'updateVerification';

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Partnership']))
        {
            $model->attributes=$_POST['Partnership'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('updateVerification',array(
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
        // $dataProvider=new CActiveDataProvider('Partnership');
        // $this->render('index',array(
        //     'dataProvider'=>$dataProvider,
        // ));

        $criteria = new CDbCriteria;
        $criteria->compare('organization_id', $org);
        $dataProvider = new CActiveDataProvider('Partnership', array(
            'criteria' => $criteria,
        ));

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Partnership('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Partnership']))
            $model->attributes=$_GET['Partnership'];

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
        $model=Partfile::model()->findByPk($id);
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
        $model=Partnership::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='partnership-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}