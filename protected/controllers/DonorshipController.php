<?php

class DonorshipController extends Controller
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
                'actions'=>array('index','view', 'donorAutoComplete'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create', 'update'),
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
            'create' => 'application.components.actions.OrgCreateAction',
            'update' => 'application.components.actions.OrgUpdateAction',
            'delete' => 'application.components.actions.OrgDeleteAction',
            'index' => 'application.components.actions.OrgIndexAction',
            'admin' => 'application.components.actions.AdminAction',
        );
    }

    /**
     * Search model for auto complete term.
     * @param string $term the search text.
     */
    public function actionDonorAutoComplete($term)
    {
        header('Content-type: application/json');
        $criteria = new CDbCriteria();

        $criteria->compare('name', $term, true);
        $criteria->limit = 5;

        $data = Donor::model()->findAll($criteria);

        $result = array();
        foreach ($data as $m) {
            $result[] = array(
                'value' => $m->name,
                'label' => $m->name . ' (' . Lookup::item('DonorshipSource', $m->source) . ')',
            );
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }
}
