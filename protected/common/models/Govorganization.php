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
            array(
                'type',
                'application.components.validators.ExistRelationValidator',
            ),
            array('profile', 'profileRelationValidator'),
            // array('type', 'exist', 'attributeName' => 'id', 'className' => 'Orgtype'),


            array('name, type, action_area', 'required'),
            array('action_area, city_id, address_id, foundation_year, staff_size', 'numerical', 'integerOnly'=>true),
            array('name, website, email', 'length', 'max'=>128),
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
            array('phone_num', 'safe'),
            array('action_area', 'in', 'range' => self::model()->ActionArea->rule),

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
            'inforequests' => array(self::HAS_MANY, 'Inforequest', 'govorganization_id'),
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
            'TabularBehavior' => array(
                'class' => 'application.components.behaviors.TabularBehavior',
                'relations' => array(
                    // array('name' => 'profile', 'delete' => true),

                    'organization' => array(),
                    'type' => array(),
                    'profile' => array('method' => 'profileTabular', 'save' => true, 'delete' => true),
                ),
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
            'Status' => array(
                'class' => 'application.components.behaviors.constants.OrganizationStatusBehavior',
                'attribute' => 'status',
            ),
            'TypeGroup' => array(
                'class' => 'application.components.behaviors.constants.OrtypeGroupBehavior',
                'attribute' => 'type_group',
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
            'type_group' => 'Группа Формы',
            'type' => 'Форма Организации',
            'action_area' => 'Масштаб Деятельности',
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
            'profile' => 'Профиль',
            'parent' => 'Организация Предок',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->with = array(
            'type',
        );

        $criteria->compare('type.id', $this->type);

        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.action_area', $this->action_area);
        $criteria->compare('t.city_id', $this->city_id);
        $criteria->compare('t.address_id', $this->address_id);
        $criteria->compare('t.foundation_year', $this->foundation_year);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'type' => array(
                        'asc' => 'type.id',
                        'desc' => 'type.id DESC',
                    ),
                    'name',
                    'action_area',
                ),
            ),
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

            $this->status = $this->Status->find('MODERATION');
            $this->verified = false;

            // TODO: get author form user model.
            $this->author_id = 1;

            // Set default logo.
            if (empty($this->logo)) {
                $this->logo = 'placeholder.jpg';
            }
        }

        // Get group from type relation.
        if (!empty($this->type)) {
            if (!is_object($this->type)) {
                $this->type = Orgtype::model()->findByPk($this->type);
            }
            $this->type_group = $this->type->group;
        }

        return parent::beforeSave();
    }

    /**
     * Relations with new models 'TabularBehavior' handler.
     * @return array of relation models or single model.
     */
    public function profileRelationValidator($attribute, $params)
    {
        $relation = null;
        $valid = true;

        if (!empty($this->$attribute)) {
            if (is_object($this->$attribute)) {
                $model = $this->$attribute;
            } else {
                $model = Govprofile::model()->findByAttributes(array(
                    'id' => $this->{$attribute}['id'],
                    'organization_id' => $this->id,
                ));
                if (is_null($model)) {
                    $model = new Govprofile;
                }

                $model->attributes = $this->$attribute;
            }

            $relation = $model;
            $valid = $model->validate() && $valid;
        }

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
    }
}
