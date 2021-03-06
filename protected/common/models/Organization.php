<?php

/**
 * This is the model class for table "{{organization}}".
 *
 * The followings are the available columns in table '{{organization}}':
 * @property integer $id
 * @property string $name
 * @property integer $type
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
 * @property integer $create_time
 * @property integer $status
 * @property integer $verified
 *
 * The followings are the available model relations:
 * @property OrganizationDirection[] $organizationDirections
 * @property OrganizationProblem[] $organizationProblems
 * @property Verification[] $verifications
 */
class Organization extends CActiveRecord
{
    const ACTION_AREA_NATION = 1;
    const ACTION_AREA_REGION = 2;
    const ACTION_AREA_DISTRICT = 3;
    const ACTION_AREA_CITY = 4;
    const ACTION_AREA_COUNTRY = 5;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_MODERATION = 3;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Organization the static model class
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
        return 'org_organization';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type, action_area', 'required'),
            array('action_area', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'min'=>3, 'max'=>128),
            array('action_area', 'in', 'range' => array(
                self::ACTION_AREA_NATION, self::ACTION_AREA_REGION,
                self::ACTION_AREA_DISTRICT, self::ACTION_AREA_CITY,
                self::ACTION_AREA_COUNTRY,
            )),

            array(
                'city_id, address_id, foundation_year, staff_size',
                'numerical', 'integerOnly'=>true, 'on'=>'update',
            ),
            array(
                'website, email',
                'length', 'min'=>3, 'max'=>128, 'on'=>'update',
            ),
            array(
                'description, goal',
                'filter',
                'filter' => array($obj = new CHtmlPurifier(), 'purify')
            ),
            array('phone_num, directions, problems', 'safe', 'on'=>'update'),
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
            array('email', 'email', 'on'=>'update'),
            array('website', 'url', 'on'=>'update'),

            array('status, verified', 'safe', 'on'=>'editable'),

            array('directions, problems, id, name, type_group, type, action_area, city_id, address_id, foundation_year, staff_size, website, email, author_id, create_time, status, verified', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'type' => array(self::BELONGS_TO, 'Orgtype', 'type_id'),
            'directions' => array(self::MANY_MANY, 'Direction', 'org_organization_direction(organization_id, direction_id)'),
            'problems' => array(self::MANY_MANY, 'Problem', 'org_organization_problem(organization_id, problem_id)'),
            'verifications' => array(self::HAS_MANY, 'Verification', 'organization_id'),
            'announcements' => array(self::HAS_MANY, 'Announcement', 'organization_id'),
            'events' => array(self::HAS_MANY, 'Event', 'organization_id'),
            'albums' => array(self::HAS_MANY, 'Album', 'organization_id'),
            'images' => array(self::HAS_MANY, 'Image', 'organization_id'),
            'achievements' => array(self::HAS_MANY, 'Achievement', 'organization_id'),
            'massmedias' => array(self::HAS_MANY, 'Massmedia', 'organization_id'),
            'companys' => array(self::HAS_MANY, 'Company', 'organization_id'),
            'catorganizations' => array(self::HAS_MANY, 'Catorganization', 'organization_id'),
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
            // Update all 'Inforequest' related records if 'attributeSource'
            // was changed.
            'InforequestUpdateBehavior' => array(
                'class' => 'application.components.behaviors.InforequestUpdateBehavior',
                'attributeSource' => 'name',
                'attributeCompare' => 'sender_id',
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
            'directions' => 'Направления',
            'problems' => 'Проблематики',
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
            'directions' => array('select' => false),
            'problems' => array('select' => false),
            'type',
        );

        if (!empty($this->directions)) {
            $criteria->with['directions']['together'] = true;
            $criteria->addInCondition('directions.id', $this->directions);
        }

        if (!empty($this->problems)) {
            $criteria->with['problems']['together'] = true;
            $criteria->addInCondition('problems.id', $this->problems);
        }

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

            $this->status = self::STATUS_MODERATION;
            $this->verified = false;

            // TODO: get author form user model.
            $this->author_id = 1;

            // Set default logo.
            if (empty($this->logo)) {
                $this->logo = 'placeholder.jpg';
            }
        }

        // Get group from type relation.
        $this->type_group = $this->type->group;

        return parent::beforeSave();
    }

    /**
     * Finds latest Organization models.
     * @param int $limit the limit of Organization array.
     * @return array of Organization models.
     */
    public static function getLatestOrganizations($limit)
    {
        $criteria=new CDbCriteria;

        $criteria->order = 'id DESC';
        $criteria->limit = $limit;

        return Organization::model()->findAll($criteria);
    }
}
