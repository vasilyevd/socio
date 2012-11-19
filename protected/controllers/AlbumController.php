<?php

class AlbumController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete, deleteAlbumImage', // we only allow deletion via POST request
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
            // array('allow', // allow authenticated user to perform 'create' and 'update' actions
            //     'actions'=>array('create','update'),
            //     'users'=>array('@'),
            // ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('*'),
            ),

            // Allow authenticated user to perform 'update' for his own model.
            array(
                'allow',
                'actions' => array('update'),
                'users' => array('*'),
                'expression' => array($this, 'isOwner'),
            ),
            // Allow authenticated user to perform 'create' for his own
            // organization.
            array(
                'allow',
                'actions' => array('create'),
                'users' => array('*'),
                'expression' => array($this, 'isOrganizationOwner'),
            ),
            // Allow authenticated user to perform 'createAlbumImage',
            // 'updateAlbumImage', 'deleteAlbumImage' for his own organization,
            // check by album and image link.
            array(
                'allow',
                'actions' => array(
                    'createAlbumImage',
                    'updateAlbumImage',
                    'deleteAlbumImage',
                ),
                'users' => array('*'),
                'expression' => array($this, 'isOrganizationOwnerByLink'),
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
     */
    public function actionCreate($org)
    {
        $model=new Album;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Album']))
        {
            $model->attributes=$_POST['Album'];

            $model->organization_id = $org;

            if($model->save())
                // $this->redirect(array('view','id'=>$model->id));
                $this->redirect(array('index','org'=>$model->organization_id));
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

        if(isset($_POST['Album']))
        {
            $model->attributes=$_POST['Album'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

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
        $model=Organization::model()->findByPk($org);
        if($model===null)
            throw new CHttpException(404,'Не найдено.');

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Album('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Album']))
            $model->attributes=$_GET['Album'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Creates link between album and image.
     * @param integer $album the ID of album component for link.
     * @param integer $image the ID of image component for link.
     */
    public function actionCreateAlbumImage($album, $image)
    {
        $model = new AlbumImage;

        // Set values for first open, later get replaced by POST.
        $model->image_id = $image;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['AlbumImage']))
        {
            $model->attributes = $_POST['AlbumImage'];
            if($model->save()) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'content' => 'Картинка скопирована в альбом.'
                ));
                exit;
            }
        }

        $organization = Album::model()->findByPk($album)->organization;
        echo CJSON::encode(array(
            'status' => 'failure',
            'content' => $this->renderPartial('_formAlbumImage', array(
                'model' => $model,
                'organization' => $organization,
            ), true)
        ));
        exit;
    }

    /**
     * Updates link between album and image.
     * @param integer $album the ID of album component for link.
     * @param integer $image the ID of image component for link.
     */
    public function actionUpdateAlbumImage($album, $image)
    {
        $model = $this->loadAlbumImage($album, $image);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['AlbumImage']))
        {
            $model->attributes = $_POST['AlbumImage'];
            if($model->save()) {
                echo CJSON::encode(array(
                    'status' => 'refresh',
                    'content' => 'Картинка перенесена в альбом.'
                ));
                exit;
            }
        }

        $organization = Album::model()->findByPk($album)->organization;
        echo CJSON::encode(array(
            'status' => 'failure',
            'content' => $this->renderPartial('_formAlbumImage', array(
                'model' => $model,
                'organization' => $organization,
            ), true)
        ));
        exit;
    }

    /**
     * Deletes all links for this album and image.
     * @param integer $album the ID of album component for link.
     * @param integer $image the ID of image component for link.
     */
    public function actionDeleteAlbumImage($album, $image)
    {
        $this->loadAlbumImage($album, $image)->delete();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Album::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'Не найдено.');
        return $model;
    }

    /**
     * Loads AlbumImage model.
     * @param integer $album the ID of album component for link.
     * @param integer $image the ID of image component for link.
     */
    public function loadAlbumImage($album, $image)
    {
        $model = AlbumImage::model()->find(
            'album_id=:album_id AND image_id=:image_id',
            array(
                ':album_id' => $album,
                ':image_id' => $image,
            ));
        if($model===null)
            throw new CHttpException(404,'Не найдено.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Checks if user owns this model.
     * @param $user is the current application user object.
     * @param $rule is this access rule.
     */
    public function isOwner($user, $rule)
    {
        $model = $this->loadModel($_GET['id']);
        // return $user->id === $model->organization->author_id;
        // TODO: placeholder, replace with above line.
        return '1' === $model->organization->author_id;
    }

    /**
     * Checks if user owns organization.
     * @param $user is the current application user object.
     * @param $rule is this access rule.
     */
    public function isOrganizationOwner($user, $rule)
    {
        $organization = Organization::model()->findByPk($_GET['org']);
        if($organization === null) {
            return false;
        }
        // return $user->id === $organization->author_id;
        // TODO: placeholder, replace with above line.
        return '1' === $organization->author_id;
    }

    /**
     * Checks if album and image got same organization and current user owns
     * this organization.
     * @param $user is the current application user object.
     * @param $rule is this access rule.
     */
    public function isOrganizationOwnerByLink($user, $rule)
    {
        // If exists and same organization.
        $album = Album::model()->findByPk($_GET['album']);
        $image = Image::model()->findByPk($_GET['image']);
        if ($album === null || $image === null ||
            $album->organization_id != $image->organization_id) {
            return false;
        }

        // return $user->id === $album->organization->author_id;
        // TODO: placeholder, replace with above line.
        return '1' === $album->organization->author_id;
    }
}
