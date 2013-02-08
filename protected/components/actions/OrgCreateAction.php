<?php

class OrgCreateAction extends CAction
{
    public function run()
    {
        if (!isset($_GET['org'])) {
            throw new CHttpException(400, 'Некорректный запрос.');
        }
        $controller = $this->getController();
        $modelName = ucfirst($controller->getId());

        // Create the model.
        $model = new $modelName;

        // Uncomment the following line if AJAX validation is needed.
        $controller->performAjaxValidation($model);

        if (isset($_POST[$modelName])) {
            $model->attributes = $_POST[$modelName];

            // Set organization relation.
            $model->organization = $_GET['org'];

            if ($model->save()) {
                $controller->redirect(array('view', 'id' => $model->id));
            }
        }

        // Escalate organization for view.
        $controller->escalateOrganization($_GET['org']);

        $controller->render('create', array(
            'model' => $model,
        ));
    }
}
