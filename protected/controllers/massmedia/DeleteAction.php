<?php

Yii::import('application.controllers.massmedia.BaseMassmediaAction');

class DeleteAction extends BaseMassmediaAction
{
    public function run()
    {
        if (!isset($_GET['id']))
            throw new CHttpException(400, 'Некорректный запрос.');
        $controller = $this->getController();
        $controllerModel = $this->getControllerModel();
        $routePrefix = $this->getRoutePrefix();

        $model = $controllerModel->loadModel($_GET['id']);
        $model->delete();
        if(!isset($_GET['ajax']))
            $controller->redirect(array('index','org' => $model->organization_id));
    }
}
