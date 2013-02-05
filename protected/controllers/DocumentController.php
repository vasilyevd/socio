<?php

class DocumentController extends Controller
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
                'actions'=>array('index','view', 'docauthorAutoComplete'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update', 'editableUpdate'),
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
            'view' => 'application.components.actions.ViewAction',
            'create' => 'application.components.actions.CreateAction',
            'update' => 'application.components.actions.UpdateAction',
            'delete' => 'application.components.actions.DeleteAction',
            'index' => 'application.components.actions.SearchIndexAction',
            'admin' => 'application.components.actions.AdminAction',

            // Editable fields and widgets update model action.
            'editableUpdate' => 'application.components.actions.EditableUpdateAction',
        );
    }

    /**
     * Search model for auto complete term.
     * @param string $term the search text.
     */
    public function actionDocauthorAutoComplete($term)
    {
        header('Content-type: application/json');
        $criteria = new CDbCriteria();

        $criteria->compare('name', $term, true);
        $criteria->limit = 5;

        $data = Docauthor::model()->findAll($criteria);

        $result = array();
        foreach ($data as $m) {
            $result[] = array(
                'value' => $m->name,
                'label' => $m->name,
            );
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }
}
