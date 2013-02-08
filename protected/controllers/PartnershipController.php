<?php

class PartnershipController extends Controller
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
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // General CRUD actions.
            'view' => 'application.components.actions.OrgViewAction',
            // 'create' => 'application.components.actions.OrgCreateAction',
            // 'update' => 'application.components.actions.OrgUpdateAction',
            'delete' => 'application.components.actions.OrgDeleteAction',
            'index' => 'application.components.actions.OrgIndexAction',
            'admin' => 'application.components.actions.AdminAction',
        );
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
            // Upload handler.
            $model->logo = CUploadedFile::getInstance($model, 'logo');

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

        if(isset($_POST['Partnership']))
        {
            $model->attributes=$_POST['Partnership'];

            // Upload handler.
            $model->logo = CUploadedFile::getInstance($model, 'logo');

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

        // Escalate organization for view.
        $this->escalateOrganization($model->organization);

        $this->render('updateVerification',array(
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
}
