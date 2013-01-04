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
            array('donor, description, source, type, delivery_year, funds', 'required'),
            array('source, type, delivery_year, funds, funds_specific', 'numerical', 'integerOnly'=>true),
            array('source', 'in', 'range' => array(
                Cooperation::SOURCE_INTERNATIONAL, Cooperation::SOURCE_PUBLIC,
                Cooperation::SOURCE_GOVERNMENT, Cooperation::SOURCE_BUSINESS,
            )),
            array('type', 'in', 'range' => array(
                Cooperation::TYPE_SOME, Cooperation::TYPE_OTHER,
                Cooperation::TYPE_MORE,
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
            'donor' => 'Донор',
            'description' => 'Описание',
            'create_time' => 'Время Создания',
            'organization' => 'Организация',
            'source' => 'Источник',
            'type' => 'Тип',
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
        if ($this->isNewRecord) {
            // Save current time.
            $this->create_time = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }
}
