<?php

/**
 * This is the model class for table "org_govorganization".
 *
 * The followings are the available columns in table 'org_govorganization':
 * @property integer $id
 * @property string $name
 * @property integer $type_group
 * @property integer $type_id
 * @property integer $action_area
 * @property integer $city_id
 * @property integer $address_id
 * @property integer $foundation_year
 * @property integer $staff_size
 * @property string $description
 * @property string $goal
 * @property string $website
 * @property string $phone_num
 * @property string $email
 * @property string $logo
 * @property string $logobg
 * @property string $logobgset
 * @property integer $author_id
 * @property string $create_time
 * @property integer $status
 * @property integer $verified
 *
 * The followings are the available model relations:
 * @property Orgtype $type
 * @property Govprofile[] $govprofiles
 * @property Govprofile[] $govprofiles1
 */
class Govorganization extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Govorganization the static model class
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
        return 'org_govorganization';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type, action_area', 'required'),
            array('action_area, city_id, address_id, foundation_year, staff_size', 'numerical', 'integerOnly'=>true),
            array('name, website, email', 'length', 'max'=>128),
            array('action_area', 'in', 'range' => array_keys(self::model()->ActionArea->list)),
            array(
                'description, goal',
                'filter',
                'filter' => array($obj = new CHtmlPurifier(), 'purify'),
            ),
            array('email', 'email'),
            array('website', 'url'),
            // Upload handler.
            array(
                'logo',
                'file',
                'allowEmpty' => true,
                // 'maxFiles' => 10,
                'maxSize' => 2*(1024*1024), //2MB
                'minSize' => 1024, //1KB
                'types' => 'jpeg, jpg, gif, png',
                // 'mimeTypes' => 'image/jpeg, image/gif, image/png',
                'on' => 'update',
            ),
            array('phone_num, directions, problems', 'safe'),

            // array('directions, problems, id, name, type_group, type, action_area, city_id, address_id, foundation_year, staff_size, website, email, author_id, create_time, status, verified', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'type' => array(self::BELONGS_TO, 'Orgtype', 'type_id'),
            'profile' => array(self::HAS_ONE, 'Govprofile', 'organization_id'),
            'parent' => array(
                self::HAS_ONE,
                'Govorganization',
                array('parent_id' => 'id'),
                'through' => 'profile',
            ),
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
            // Upload handler.
            'UploadBehavior' => array(
                'class' => 'application.components.behaviors.UploadBehavior',
                'attributes' => array('logo'),
            ),
            // Constants.
            'ActionArea' => array(
                'class' => 'application.components.behaviors.constants.OrganizationActionAreaBehavior',
                'attribute' => 'action_area',
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
            'type_group' => 'Группа Типа',
            'type' => 'Тип',
            'action_area' => 'Область Действий',
            'city_id' => 'Город',
            'address_id' => 'Адрес',
            'foundation_year' => 'Год Основания',
            'staff_size' => 'Количество Сотрудников',
            'description' => 'Описание',
            'goal' => 'Задачи',
            'website' => 'Сайт',
            'phone_num' => 'Номера Телефонов',
            'email' => 'Емейл',
            'logo' => 'Лого',
           'logobg'=>'Фоновое изображение',
           'logobgset'=>'Позиция фона',
            'author_id' => 'Автор',
            'create_time' => 'Время Создания',
            'status' => 'Статус',
            'verified' => 'Проверенно',
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
        $criteria->compare('type_group',$this->type_group);
        $criteria->compare('type_id',$this->type_id);
        $criteria->compare('action_area',$this->action_area);
        $criteria->compare('city_id',$this->city_id);
        $criteria->compare('address_id',$this->address_id);
        $criteria->compare('foundation_year',$this->foundation_year);
        $criteria->compare('staff_size',$this->staff_size);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('goal',$this->goal,true);
        $criteria->compare('website',$this->website,true);
        $criteria->compare('phone_num',$this->phone_num,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('logobg',$this->logobg,true);
        $criteria->compare('logobgset',$this->logobgset,true);
        $criteria->compare('author_id',$this->author_id);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('verified',$this->verified);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
