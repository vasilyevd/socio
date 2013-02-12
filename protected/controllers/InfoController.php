<?php

class InfoController extends Controller
{

	public $sectionMain='obj';
	public $sectionMainSub='info';

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
	public $defaultAction = 'metodic';

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'view', 'section', 'metodic'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()	{
		$model = new Infoitem('search');
		$model->unsetAttributes();
		$model->section = 1;

		$this->render('index',array(
				'model'=>$model,
			));
	}

	public function actionSection($id)	{
		$model = new Infoitem('search');
		$model->unsetAttributes();
		$model->section = $id;

		$this->render('section',array(
				'model'=>$model,
			));
	}

	public function actionMetodic()	{
		$this->redirect( Yii::app()->createUrl('/info/section',array('id'=>3)) );
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


	public function loadModel($id)
	{
		$model= Infoitem::model()->findByPk($id);
		if($model===NULL)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function getInfoMenu($model=null){
		return array(
			array('label' => 'Контроль', 'url' => array('info/index'),'active'=>$model->section==1),
			array('label' => 'Власть', 'url' => array('info/section', 'id'=>2),'active'=>$model->section==2),
			array('label' => 'Обучение', 'url' => array('info/section', 'id' =>3),'active'=>$model->section==3),
			array('label' => 'Программы', 'url' => array('info/section', 'id' =>4),'active'=>$model->section==4),
			array('label' => 'Инваспорт', 'url' => array('info/section', 'id' =>5),'active'=>$model->section==5),
			array('label' => 'Инватуризм', 'url' => array('info/section', 'id' =>6),'active'=>$model->section==6),
		);
	}

}
