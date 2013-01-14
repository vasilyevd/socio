<?php

class DeleteAction extends CAction
{
    public function run()
    {
        if (!isset($_GET['id']))
            throw new CHttpException(400, 'Некорректный запрос.');
        $controller = $this->getController();

        $model = $this->loadModel($_GET['id']);
        $model->delete();
        if(!isset($_GET['ajax']))
            $controller->redirect(array('index','org' => $model->organization_id));
    }

    public function loadModel($id)
    {
        $model=Massmedia::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}
