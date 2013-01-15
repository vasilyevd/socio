<?php

class ViewAction extends BaseMassmediaAction
{
    public function run()
    {
        if (!isset($_GET['id']))
            throw new CHttpException(400, 'Некорректный запрос.');
        $controller = $this->getController();
        $controllerModel = $this->getControllerModel();
        $routePrefix = $this->getRoutePrefix();

        $model = $controllerModel->loadModel($_GET['id']);

        // Escalate organization for view.
        $controller->escalateOrganization($model->organization);

        $controller->render('//massmedia/view', array(
            'model' => $model,
            'routePrefix' => $routePrefix,
        ));
    }
}
