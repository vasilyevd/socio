<?php

class InforequestController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to
     * '//layouts/column2', meaning using two-column layout. See
     * 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters.
     */
    public function filters()
    {
        return array(
            // Perform access control for CRUD operations.
            'accessControl',
            // We only allow deletion via POST request.
            'postOnly + delete',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules.
     */
    public function accessRules()
    {
        return array(
            // Allow all users to perform 'index' and 'view' actions.
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            // Allow authenticated to perform 'create' and 'update' actions.
            array('allow',
                'actions' => array('create', 'update'),
                'users' => array('*'),
            ),
            // Allow admin user to perform 'admin' and 'delete' actions.
            array('allow',
                'actions' => array('admin', 'delete'),
                'users' => array('*'),
            ),
            // Deny all users.
            array('deny',
                'users' => array('*'),
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
            'index' => 'application.components.actions.IndexAction',
            'admin' => 'application.components.actions.AdminAction',
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Inforequest;

        // Uncomment the following line if AJAX validation is needed.
        $this->performAjaxValidation($model);

        if (isset($_POST['Inforequest'])) {
            // Set custom scenario for model based on 'sender_type' value.
            switch ($_POST['Inforequest']['sender_type']) {
                case $model->SenderType->find('USER'):
                    $model->scenario = 'senderUser';
                    break;
                case $model->SenderType->find('ORGANIZATION'):
                    $model->scenario = 'senderOrganization';
                    break;
                case $model->SenderType->find('BIZORGANIZATION'):
                    $model->scenario = 'senderBizorganization';
                    break;
            }

            $model->attributes = $_POST['Inforequest'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed.
        $this->performAjaxValidation($model);

        if (isset($_POST['Inforequest'])) {
            // Set custom scenario for model based on 'sender_type' value.
            switch ($_POST['Inforequest']['sender_type']) {
                case $model->SenderType->find('USER'):
                    $model->scenario = 'senderUser';
                    break;
                case $model->SenderType->find('ORGANIZATION'):
                    $model->scenario = 'senderOrganization';
                    break;
                case $model->SenderType->find('BIZORGANIZATION'):
                    $model->scenario = 'senderBizorganization';
                    break;
            }

            $model->attributes = $_POST['Inforequest'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
}
