<?php

/**
 * This is the model class for table "org_company".
 *
 * The followings are the available columns in table 'org_company':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Massmedia[] $massmedias
 */
class Company extends CActiveRecord
{
    public $compareDate;
    public $compareDateType;

    const TYPE_INFORMATIONAL = 1;
    const TYPE_ADVERTISEMENT = 2;
    const TYPE_LEGAL = 3;
    const TYPE_PR = 4;

    const COMPARE_DATE_TYPE_BEFORE = 1;
    const COMPARE_DATE_TYPE_AFTER = 2;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Company the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'org_company';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type, description, massmedias', 'required'),
            array('name', 'length', 'max'=>128),
            array('type', 'numerical', 'integerOnly'=>true),
            array('type', 'in', 'range' => array(
                self::TYPE_INFORMATIONAL, self::TYPE_ADVERTISEMENT,
                self::TYPE_LEGAL, self::TYPE_PR,
            )),

            array('type, compareDate, compareDateType', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'massmedias' => array(self::HAS_MANY, 'Massmedia', 'company_id'),
        );
    }

    /**
     * @return array behaviors for current model.
     */
    public function behaviors()
    {
        return array(
            // Advanced relations
            'EActiveRecordRelationBehavior' => array(
                'class' => 'application.components.behaviors.EActiveRecordRelationBehavior'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'type' => 'Тип',
            'description' => 'Описание',
            'organization_id' => 'Организация',
            'massmedias' => 'Элементы СМИ',
            'min_date' => 'Минимальная Дата',
            'max_date' => 'Максимальная Дата',
            'compareDate' => 'Сравнить Даты',
            'compareDateType' => 'Тип Сравнения Даты',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        // Relation.
        $criteria->with = array();

        // Relation BELONGS_TO search.
        if (!empty($this->organization)) {
            $criteria->with = array_merge($criteria->with, array(
                'organization',
            ));
            $criteria->compare('organization.id', $this->organization);
        }

        // Check date range.
        if (!empty($this->compareDate)) {
            $criteria->params = array_merge($criteria->params, array(
                ':compareDate' => $this->compareDate,
            ));
            // Select compare mode.
            if ($this->compareDateType == self::COMPARE_DATE_TYPE_BEFORE) {
                // Find all before 'compareDate'.
                $criteria->addCondition('t.max_date <= :compareDate');
            } elseif ($this->compareDateType == self::COMPARE_DATE_TYPE_AFTER) {
                // Find all after 'compareDate'.
                $criteria->addCondition('t.min_date >= :compareDate');
            } else {
                // Find all in date range.
                $criteria->addCondition('t.min_date <= :compareDate');
                $criteria->addCondition('t.max_date >= :compareDate');
            }
        }

        $criteria->compare('t.type', $this->type);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 2,
            ),
        ));
    }

    /**
     * This is invoked after the record is saved.
     */
    public function afterSave()
    {
        parent::afterSave();

        // Update date ranges ('min_date' and 'max_date') for company.
        $this->isNewRecord = false;
        $this->updateDateRange();
    }

    /**
     * Finds homeless Massmedia elements.
     */
    public function getHomelessMassmedia()
    {
        if ($this->isNewRecord) {
            $models = Massmedia::model()->findAll(
                'organization_id=:organization_id AND company_id IS NULL',
                array('organization_id' => $_GET['org'])
            );
        } else {
            $models = Massmedia::model()->findAll(
                'organization_id=:organization_id AND (company_id=:company_id OR company_id IS NULL)',
                array('organization_id' => $this->organization->id, ':company_id' => $this->id)
            );
        }

        return $models;
    }

    /**
     * Updates 'min_date' and 'max_date' for current model, based on it's
     * massmedias 'publication_date' and 'create_time'.
     */
    public function updateDateRange()
    {
        // Create query.
        $query = 'SELECT MIN(rdate) AS rmindate, MAX(rdate) AS rmaxdate FROM (SELECT IF (publication_date IS NULL, date(create_time), publication_date) AS rdate FROM org_massmedia WHERE company_id=:company_id) AS t2';
        $command = Yii::app()->db->createCommand($query);
        $command->bindValue(':company_id', $this->id);
        $result = $command->queryRow();

        // Set new range values.
        if ($result) {
            $this->min_date = $result['rmindate'];
            $this->max_date = $result['rmaxdate'];
        } else {
            $this->min_date = '0000-00-00';
            $this->max_date = '0000-00-00';
        }

        // Update record.
        $this->saveAttributes(array('min_date', 'max_date'));
    }
}
