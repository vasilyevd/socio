<?php

/**
 * This is the model class for table "org_event".
 *
 * The followings are the available columns in table 'org_event':
 * @property integer $id
 * @property integer $organization_id
 * @property integer $author_id
 * @property string $name
 * @property integer $category
 * @property integer $type_id
 * @property string $type_other
 * @property string $create_time
 * @property string $start_time
 * @property string $end_time
 * @property integer $city_id
 * @property integer $address_id
 * @property string $address_other
 * @property string $address_description
 * @property string $description
 * @property integer $status
 * @property integer $invite_closed
 *
 * The followings are the available model relations:
 * @property EventType $type
 * @property Organization $organization
 */
class Event extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const TYPE_OTHER_ORGANIZATIONAL = 1;
    const TYPE_OTHER_INTERNAL = 2;
    const TYPE_OTHER_PUBLIC = 3;

    const END_TIME_ALL = 1;
    const END_TIME_PAST = 2;
    const END_TIME_FUTURE = 3;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Event the static model class
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
        return 'org_event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, status, type_id, start_time, city_id, description', 'required'),
            array('status, type_id, city_id, address_id', 'numerical', 'integerOnly'=>true),
            array('name, type_other, address_other', 'length', 'max'=>128),
            array('address_description', 'safe'),
            array('start_time, end_time', 'date', 'format'=>'yyyy-MM-dd HH:mm:ss'),
            array('status', 'in', 'range' => array(
                self::STATUS_ACTIVE, self::STATUS_INACTIVE,
            )),
            array('description','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),

            array('id, organization_id, author_id, name, category, type_id, type_other, create_time, start_time, end_time, city_id, address_id, address_other, address_description, description, status, invite_closed', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'type' => array(self::BELONGS_TO, 'Evtype', 'type_id'),
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'organization_id' => 'Организация',
            'author_id' => 'Автор',
            'name' => 'Название',
            'category' => 'Категория',
            'type_id' => 'Тип',
            'type' => 'Тип',
            'type_other' => 'Тип Другой',
            'create_time' => 'Время Создания',
            'start_time' => 'Время Начала',
            'end_time' => 'Время Окончания',
            'city_id' => 'Город',
            'address_id' => 'Адрес',
            'address_other' => 'Адрес Другой',
            'address_description' => 'Адрес Описание',
            'description' => 'Описание',
            'status' => 'Статус',
            'invite_closed' => 'Приглашение Закрыто',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        // Relation.
        $criteria->with = array();

        // Relation BELONGS_TO search.
        if (!empty($this->organization)) {
            $criteria->with = array_merge($criteria->with, array(
                'organization',
            ));
            $criteria->compare('organization.id', $this->organization);
        }

        // Check 'end_time' selected values.
        if ($this->end_time == self::END_TIME_PAST) {
            $criteria->addCondition('date(t.end_time) < NOW()');
        } elseif ($this->end_time == self::END_TIME_FUTURE) {
            $criteria->addCondition('date(t.end_time) > NOW()');
        }

        // Check for whole day.
        $criteria->compare('date(t.start_time)',$this->start_time);

        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.category',$this->category);
        $criteria->compare('t.type_id',$this->type_id);
        $criteria->compare('t.city_id',$this->city_id);
        $criteria->compare('t.status',$this->status);

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
        if ($this->isNewRecord) {
            // Save current time.
            $this->create_time = new CDbExpression('NOW()');

            // TODO: get author form user model.
            $this->author_id = 1;
        }

        // Default 'end_time'.
        if (empty($this->end_time)) {
            $this->end_time = $this->start_time;
        }

        // Manage 'type_other' if selected proper element.
        if ($this->type_id == self::TYPE_OTHER_ORGANIZATIONAL ||
            $this->type_id == self::TYPE_OTHER_INTERNAL ||
            $this->type_id == self::TYPE_OTHER_PUBLIC
        ) {
            // Default 'type_other' if blank.
            if (empty($this->type_other)) {
                $this->type_other = 'Другой';
            }
        // Blank 'type_other' if not selected element.
        } else {
            $this->type_other = '';
        }

        // Get category from models type relation.
        $this->category = $this->type->category;

        return parent::beforeSave();
    }
}
