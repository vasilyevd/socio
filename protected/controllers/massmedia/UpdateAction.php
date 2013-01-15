<?php

class UpdateAction extends BaseMassmediaAction
{
    public function run()
    {
        if (!isset($_GET['id']))
            throw new CHttpException(400, 'Некорректный запрос.');
        $controller = $this->getController();
        $controllerModel = $this->getControllerModel();
        $routePrefix = $this->getRoutePrefix();

        $model = $controllerModel->loadModel($_GET['id']);

        // Uncomment the following line if AJAX validation is needed
        $controllerModel->performAjaxValidation($model);

        if(isset($_POST['Massmedia']))
        {
            $model->attributes=$_POST['Massmedia'];

            // Relations.
            $model->links = $_POST['Mmlink'];
            $model->files = $_POST['Mmfile'];

            if($model->save())
                $controller->redirect(array($routePrefix . 'view','id'=>$model->id));
        }

        // Show tags relation as imploded string.
        $model->tagsToString();
        // Need at least one link for copy.
        if (empty($model->links)) {
            $model->links = array(new Mmlink);
        }
        // Need at least one file for copy.
        if (empty($model->files)) {
            $model->files = array(new Mmfile);
        }

        // Escalate organization for view.
        $controller->escalateOrganization($model->organization);

        $controller->render('//massmedia/update', array(
            'model' => $model,
            'routePrefix' => $routePrefix,
        ));
    }
}
