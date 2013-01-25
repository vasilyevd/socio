<?php

class MapController extends Controller
{

	public $sectionMain='obj';
	public $sectionMainSub='map';

	public $layout='//layouts/main';

	public function actionIndex()
	{
		$this->render('index');
	}

}