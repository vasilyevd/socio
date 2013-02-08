<?php

/**
 * This is the model class for table "org_event_type".
 *
 * The followings are the available columns in table 'org_event_type':
 * @property integer $id
 * @property string $name
 * @property integer $category
 * @property integer $position
 *
 * The followings are the available model relations:
 * @property Event[] $events
 */
class Evtype extends CActiveRecord
{
    const CATEGORY_ORGANIZATIONAL = 1;
    const CATEGORY_INTERNAL = 2;
    const CATEGORY_PUBLIC = 3;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return EventType the static model class
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
        return 'org_evtype';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, category, position', 'required'),
            array('category, position', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>128),
            array('category', 'in', 'range' => array(
                self::CATEGORY_ORGANIZATIONAL, self::CATEGORY_INTERNAL,
                self::CATEGORY_PUBLIC,
            )),

            array('id, name, category, position', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'events' => array(self::HAS_MANY, 'Event', 'type_id'),
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
            'category' => 'Категория',
            'position' => 'Позиция',
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
        $criteria->compare('category',$this->category);
        $criteria->compare('position',$this->position);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
