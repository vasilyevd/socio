<?php

class OrgIndexAction extends CAction
{
    public function run()
    {
        if (!isset($_GET['org'])) {
            throw new CHttpException(400, 'Некорректный запрос.');
        }
        $controller = $this->getController();
        $modelName = ucfirst($controller->getId());

        $criteria = new CDbCriteria;
        $criteria->compare('organization_id', $_GET['org']);

        $dataProvider = new CActiveDataProvider($modelName, array(
            'criteria' => $criteria,
        ));

        // Escalate organization for view.
        $controller->escalateOrganization($_GET['org']);

        $controller->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}
