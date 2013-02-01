<?php

class BaseMassmediaAction extends CAction
{
    public function run()
    {
        return false;
    }

    public function getControllerModel()
    {
        $controller = $this->getController();

        if ($controller->id != 'massmedia') {
            list($controller) = Yii::app()->createController('massmedia');
        }

        return $controller;
    }

    public function getRoutePrefix()
    {
        $routePrefix = '';

        $controller = $this->getController();
        if ($controller->id != 'massmedia') {
            $routePrefix = 'mm';
        }

        return $routePrefix;
    }
}
