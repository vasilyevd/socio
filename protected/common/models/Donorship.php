<?php

/**
 * This is the model class for table "org_donorship".
 *
 * The followings are the available columns in table 'org_donorship':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property integer $organization_id
 */
class Donorship extends CActiveRecord
{
    const SOURCE_INTERNATIONAL = 1;
    const SOURCE_NATIONAL = 2;
    const SOURCE_REGIONAL = 3;
    const SOURCE_PRIVATE = 4;

    const TYPE_FUNDING = 1;
    const TYPE_ASSETS_AND_CIRCULATION = 2;
    const TYPE_REPAIR_WORK = 3;
    const TYPE_RESEARCH_STUDIES = 4;
    const TYPE_EDUCATION = 5;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Donorship the static model class
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
        return 'org_donorship';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(
                'organization',
                'application.components.validators.ExistRelationValidator',
                'on' => 'insert',
            ),
            array('donor', 'donorRelationValidator'),
            array('donor, description, source, type, delivery_year, funds', 'required'),
            array('source, type, delivery_year, funds, funds_specific', 'numerical', 'integerOnly'=>true),
            array('source', 'in', 'range' => array(
                self::SOURCE_INTERNATIONAL, self::SOURCE_NATIONAL,
                self::SOURCE_REGIONAL, self::SOURCE_PRIVATE,
            )),
            array('type', 'in', 'range' => array(
                self::TYPE_FUNDING, self::TYPE_ASSETS_AND_CIRCULATION,
                self::TYPE_REPAIR_WORK, self::TYPE_RESEARCH_STUDIES,
                self::TYPE_EDUCATION,
            )),
            array('funds', 'in', 'range' => array(
                Support::FUNDS_10K, Support::FUNDS_20K,
                Support::FUNDS_80K, Support::FUNDS_OTHER,
            )),

            // array('id, name, description, create_time, organization_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'donor' => array(self::BELONGS_TO, 'Donor', 'donor_id'),
        );
    }

    /**
     * @return array behaviors for current model.
     */
    public function behaviors()
    {
        return array(
            // Advanced relations.
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
            'donor' => 'Грантодатель',
            'description' => 'Описание',
            'create_time' => 'Время Создания',
            'organization' => 'Организация',
            'source' => 'Источник',
            'type' => 'Назначение Гранта',
            'delivery_year' => 'Год Вручения',
            'funds' => 'Средства',
            'funds_specific' => 'Средства Конкретнее',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('organization_id',$this->organization_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * This is invoked before the record is validated.
     */
    public function beforeValidate()
    {
        // Don't allow empty 'funds_specific' on funds 'FUNDS_OTHER'.
        if ($this->funds == Support::FUNDS_OTHER) {
            if (empty($this->funds_specific)) {
                $this->funds = null;
            }
        // Blank 'funds_specific', if selected regular 'funds'.
        } else {
            $this->funds_specific = null;
        }

        return parent::beforeValidate();
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave()
    {
        // Relations handler.
        if (!is_null($this->donor)) $this->donor->save();

        if ($this->isNewRecord) {
            // Save current time.
            $this->create_time = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    /**
     * Transforms attribute data to relation and validates it.
     * @param string $attribute the attribute being validated.
     * @param array $params the list of validation parameters.
     */
    public function donorRelationValidator($attribute, $params)
    {
        $relation = null;
        $valid = true;

        if (!empty($this->$attribute)) {
            if (is_object($this->$attribute)) {
                $model = $this->$attribute;
            } else {
                $model = Donor::model()->findByAttributes(array(
                    'name' => $this->$attribute,
                ));
                if (is_null($model)) {
                    $model = new Donor;
                    $model->name = $this->donor;
                    $model->source = $this->source;
                }
            }

            $relation = $model;
            $valid = $model->validate() && $valid;
        }

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
    }
}
