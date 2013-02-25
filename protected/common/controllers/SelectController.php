<?php

class SelectController extends Controller
{

	const DATA_TYPE_JSON = 'json';

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

	/**
	 * Get array of city's by string, region_id
	 * Options:
	 *  term - string wthat input user for search city
	 *  simple - set construction of returned data
	 *    true - send only gated data. Like: [[d11:v11, d12:v12], [d21:v21, d22:v22]]
	 *    false - send data end other information. Like: [data: [...], error:[...], n: true, ...]
	 *    @TODO: add code for simple=false;
	 *  region - id of region. City finds only it its plased in this region
	 */
	public function actionCity() {
		$term = (isset($_POST['term'])) ? $_POST['term'] : false;
		$region = (isset($_POST['region'])) ? (int)$_POST['region'] : false;
		//$simple = (isset($_POST['simple'])) ? (int)$_POST['simple'] : true;

		if(Yii::app()->request->isAjaxRequest && $term) {
			$criteria = new CDbCriteria;
			$criteria->addSearchCondition('t.name', $term);
			if ($region>0)
				$criteria->addSearchCondition('t.region_id', $region, false);
			$criteria->order = 't.type asc';
			$criteria->limit = (strlen($term)>4) ? 30 : 15;
			$criteria->with = 'district2';

			$citys = CityUa::model()->findAll($criteria);

			// обрабатываем результат
			$data = array();
			if (count($citys)>0) {
				foreach($citys as $city) {
					$data[] = array(
						'id'=>$city['id'],
						'label'=>$city->Li,
						'value'=>$city->preName,
						'r'=>$city['region_id'],
						'd'=>$city['district'],

					);
				}
			} else {
				$data[] = array(
					'label'=>'Ничего не найдено',
					'value'=>'',
					'r'=>'',
					'd'=>''
				);
			}

			$this->sendResult($data);
			Yii::app()->end();
		}
	}

	public function actionwtf(){
		echo 'WTF';
		Yii::app()->end();
	}

	private function sendResult($data, $type=self::DATA_TYPE_JSON){
		switch ($type) {
			case self::DATA_TYPE_JSON:
			default:
				header('Content-type: application/json');
				echo CJSON::encode($data);
		}
	}



}
