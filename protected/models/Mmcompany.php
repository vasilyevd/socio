<?php

/**
 * This is the model class for table "org_mmcompany".
 *
 * The followings are the available columns in table 'org_mmcompany':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Massmedia[] $massmedias
 */
class Mmcompany extends CActiveRecord
{
    const TYPE_INFORMATIONAL = 1;
    const TYPE_ADVERTISEMENT = 2;
    const TYPE_LEGAL = 3;
    const TYPE_PR = 4;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Mmcompany the static model class
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
        return 'org_mmcompany';
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

            // array('id, name, type, description', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'massmedias' => array(self::HAS_MANY, 'Massmedia', 'mmcompany_id'),
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
        $criteria->compare('type',$this->type);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Finds homeless Massmedia elements.
     */
    public function getHomelessMassmedia()
    {
        if ($this->isNewRecord) {
            $models = Massmedia::model()->findAll(
                'organization_id=:organization_id AND mmcompany_id IS NULL',
                array('organization_id' => $_GET['org'])
            );
        } else {
            $models = Massmedia::model()->findAll(
                'organization_id=:organization_id AND (mmcompany_id=:mmcompany_id OR mmcompany_id IS NULL)',
                array('organization_id' => $this->organization->id, ':mmcompany_id' => $this->id)
            );
        }

        return $models;
    }
}
