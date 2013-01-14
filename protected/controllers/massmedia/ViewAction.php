<?php

class ViewAction extends CAction
{
    public function run()
    {
        if (!isset($_GET['id']))
            throw new CHttpException(400, 'Некорректный запрос.');
        $controller = $this->getController();

        $model = $this->loadModel($_GET['id']);

        // Escalate organization for view.
        $controller->escalateOrganization($model->organization);

        $controller->render('//massmedia/view', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model=Massmedia::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}
