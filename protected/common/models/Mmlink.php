<?php

/**
 * This is the model class for table "org_mmlink".
 *
 * The followings are the available columns in table 'org_mmlink':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $massmedia_id
 *
 * The followings are the available model relations:
 * @property Massmedia $massmedia
 */
class Mmlink extends CActiveRecord
{
    const TYPE_GENERAL = 1;
    const TYPE_YOUTUBE = 2;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Mmlink the static model class
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
        return 'org_mmlink';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>128),
            array('name', 'url'),

            // array('id, name, type, massmedia_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'massmedia' => array(self::BELONGS_TO, 'Massmedia', 'massmedia_id'),
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
            'name' => 'Адрес',
            'type' => 'Тип',
            'massmedia_id' => 'Элемент СМИ',
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
        $criteria->compare('massmedia_id',$this->massmedia_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave()
    {
        // If link is youtube type.
        if(preg_match('~(http://www\.youtube\.com/watch\?v=[%&=#\w-]*)~', $this->name)){
            $this->type = self::TYPE_YOUTUBE;
        // Else just general link
        } else {
            $this->type = self::TYPE_GENERAL;
        }

        return parent::beforeSave();
    }
}
