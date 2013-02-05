<?php

class OrgSearchIndexAction extends CAction
{
    public function run()
    {
        if (!isset($_GET['org'])) {
            throw new CHttpException(400, 'Некорректный запрос.');
        }
        $controller = $this->getController();
        $modelName = ucfirst($controller->getId());

        $model = new $modelName('search');
        // Clear any default values.
        $model->unsetAttributes();
        if (isset($_GET[$modelName])) {
            $model->attributes = $_GET[$modelName];
        }

        // Limit search to only this organization.
        $model->organization = $_GET['org'];

        // Escalate organization for view.
        $controller->escalateOrganization($_GET['org']);

        $controller->render('index', array(
            'model' => $model,
        ));
    }
}
