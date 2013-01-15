<?php

class MassmediaController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/presentation';

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
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // Forward massmedia actions for this controller.
            'view' => 'application.controllers.massmedia.ViewAction',
            'update' => 'application.controllers.massmedia.UpdateAction',
            'delete' => 'application.controllers.massmedia.DeleteAction',
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
                'actions'=>array('create','update'),
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $org the ID of the parent organization.
     */
    public function actionCreate($org)
    {
        $model=new Massmedia;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Massmedia']))
        {
            $model->attributes=$_POST['Massmedia'];

            // Relations.
            $model->organization = $org;
            $model->links = $_POST['Mmlink'];
            $model->files = $_POST['Mmfile'];

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        // Show tags relation as imploded string.
        $model->tagsToString();
        // Need at least one link for copy.
        if (empty($model->links)) {
            $model->links = array(new Mmlink);
        }
        // Need at least one file for copy.
        if (empty($model->files)) {
            $model->files = array(new Mmfile);
        }
        // Escalate organization for view.
        $this->escalateOrganization($org);

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Lists all models.
     * @param integer $org the ID of the organization model.
     */
    public function actionIndex($org)
    {
        // $dataProvider=new CActiveDataProvider('Massmedia');
        // $this->render('index',array(
        // 'dataProvider'=>$dataProvider,
        // ));

        $model=new Massmedia('search');
        $model->unsetAttributes(); // clear any default values
        if(isset($_GET['Massmedia']))
            $model->attributes=$_GET['Massmedia'];

        // Limit search to only this organization.
        $model->organization = $org;

        // Escalate organization for view.
        $this->escalateOrganization($org);

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Massmedia('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Massmedia']))
            $model->attributes=$_GET['Massmedia'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Massmedia::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='massmedia-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
