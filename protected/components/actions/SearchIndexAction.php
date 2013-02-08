<?php

class SearchIndexAction extends CAction
{
    public function run()
    {
        $controller = $this->getController();
        $modelName = ucfirst($controller->getId());

        $model = new $modelName('search');
        // Clear any default values.
        $model->unsetAttributes();

        if (isset($_GET[$modelName])) {
            $model->attributes = $_GET[$modelName];
        }

        $controller->render('index', array(
            'model' => $model,
        ));
    }
}
