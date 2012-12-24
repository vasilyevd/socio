<?php

class CooperationController extends Controller
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
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','dynamicSearchOrganizations'),
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
        $model=new Cooperation;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Cooperation']))
        {
            $model->attributes=$_POST['Cooperation'];

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

        if(isset($_POST['Cooperation']))
        {
            $model->attributes=$_POST['Cooperation'];
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
        $dataProvider=new CActiveDataProvider('Cooperation');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Cooperation('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Cooperation']))
            $model->attributes=$_GET['Cooperation'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Search organizations by its name.
     * @param string $query organization name to search.
     */
    public function actionDynamicSearchOrganizations($query)
    {
        header('Content-type: application/json');

        // Find organizations by name.
        $criteria = new CDbCriteria();
        $criteria->compare('name', $query, true);
        $criteria->limit = 5;
        $organizations = Organization::model()->findAll($criteria);

        // Add dummy organization to allow user selection.
        $dummy = new Organization;
        $dummy->name = $query;
        $dummy->id = $query;
        $dummy->logo = 'placeholder.jpg';
        $organizations[] = $dummy;

        // Change formating for view.
        foreach ($organizations as $org) {
            // Full URL for logo.
            $org->logo = $org->getUploadUrl('logo');
            // Clean and limit length for description.
            if (empty($org->description)) {
                $org->description = ' ';
            } else {
                $org->description = mb_substr(CHtml::encode(strip_tags($org->description)), 0, 100, 'UTF-8') . '...';
            }
        }

        echo CJSON::encode(array(
            'organizations' => $organizations,
        ));
        Yii::app()->end();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Cooperation::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='cooperation-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
