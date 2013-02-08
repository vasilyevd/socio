<?php

class OrgDeleteAction extends CAction
{
    public function run()
    {
        if (!isset($_GET['id'])) {
            throw new CHttpException(400, 'Некорректный запрос.');
        }
        $controller = $this->getController();

        // Load current model. And delete it.
        $model = $controller->loadModel($_GET['id']);
        $model->delete();

        // If AJAX request (triggered by deletion via admin grid view), we
        // should not redirect the browser.
        if(!isset($_GET['ajax'])) {
            $controller->redirect(array('index', 'org' => $model->organization_id));
        }
    }
}
