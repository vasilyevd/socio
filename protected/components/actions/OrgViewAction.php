<?php

class OrgViewAction extends CAction
{
    public function run()
    {
        if (!isset($_GET['id'])) {
            throw new CHttpException(400, 'Некорректный запрос.');
        }
        $controller = $this->getController();

        // Load current model.
        $model = $controller->loadModel($_GET['id']);

        // Escalate organization for view.
        $controller->escalateOrganization($model->organization);

        $controller->render('view', array(
            'model' => $model,
        ));
    }
}
