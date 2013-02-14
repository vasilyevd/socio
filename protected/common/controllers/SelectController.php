<?php

class SelectController extends Controller
{
    /**
     * Upload handler.
     * AJAX select images for text editor.
     * @param integer $org the ID of the organization model.
     */
    public function actionDynamicImageGetJson($org)
    {
        header('Content-type: application/json');

        $model = $this->loadModelByName($org, 'Organization');
        $jsonArray = array();

        foreach ($model->images as $img) {
            $jsonArray[] = array(
                'thumb' => $img->getUploadUrl('file'),
                'image' => $img->getUploadUrl('file'),
            );
        }

        echo CJSON::encode($jsonArray);
        Yii::app()->end();
    }

    /**
     * Search model for auto complete query.
     * @param string $term the search query text.
     */
    public function actionOrganizationAutoComplete($term)
    {
        header('Content-type: application/json');

        $criteria = new CDbCriteria();
        $criteria->compare('name', $term, true);
        $criteria->limit = 5;

        $data = Organization::model()->findAll($criteria);

        $result = array();
        foreach ($data as $m) {
            $result[] = array(
                'value' => $m->name,
                'label' => $m->name . ' (' . Lookup::item('OrganizationActionArea', $m->action_area) . ')',
                'id' => $m->id,
            );
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    /**
     * Search model for select2 query.
     * @param string $query the search query text.
     */
    public function actionOrganizationSelectSearch($query)
    {
        header('Content-type: application/json');

        $criteria = new CDbCriteria();
        $criteria->compare('name', $query, true);
        $criteria->limit = 5;

        $data = Organization::model()->findAll($criteria);

        $result = array();
        foreach ($data as $m) {
            // Format description for view.
            $description = '';
            if (!empty($m->description)) {
                $description = mb_substr(CHtml::encode(strip_tags($m->description)), 0, 100, 'UTF-8') . '...';
            }

            $result[] = array(
                'id' => $m->id,
                'name' => $m->name,
                'description' => $description,
                'logo' => $m->getUploadUrl('logo'),
            );
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    /**
     * Search model for auto complete query.
     * @param string $term the search query text.
     */
    public function actionDocauthorAutoComplete($term)
    {
        header('Content-type: application/json');

        $criteria = new CDbCriteria();
        $criteria->compare('name', $term, true);
        $criteria->limit = 5;

        $data = Docauthor::model()->findAll($criteria);

        $result = array();
        foreach ($data as $m) {
            $result[] = array(
                'value' => $m->name,
                'label' => $m->name,
            );
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    /**
     * Search model for auto complete query.
     * @param string $term the search query text.
     */
    public function actionDonorAutoComplete($term)
    {
        header('Content-type: application/json');

        $criteria = new CDbCriteria();
        $criteria->compare('name', $term, true);
        $criteria->limit = 5;

        $data = Donor::model()->findAll($criteria);

        $result = array();
        foreach ($data as $m) {
            $result[] = array(
                'value' => $m->name,
                'label' => $m->name . ' (' . Lookup::item('DonorshipSource', $m->source) . ')',
            );
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    /**
     * Search model for select2 query.
     * @param string $query the search query text.
     */
    public function actionGovorganizationSelectSearch($query)
    {
        header('Content-type: application/json');

        $criteria = new CDbCriteria();
        $criteria->compare('name', $query, true);
        $criteria->limit = 5;

        $data = Govorganization::model()->findAll($criteria);

        $result = array();
        foreach ($data as $m) {
            // Format description for view.
            $description = '';
            if (!empty($m->description)) {
                $description = mb_substr(CHtml::encode(strip_tags($m->description)), 0, 100, 'UTF-8') . '...';
            }

            $result[] = array(
                'id' => $m->id,
                'name' => $m->name,
                'description' => $description,
                'logo' => $m->getUploadUrl('logo'),
            );
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }
}
