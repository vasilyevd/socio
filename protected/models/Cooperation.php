<?php

/**
 * This is the model class for table "org_cooperation".
 *
 * The followings are the available columns in table 'org_cooperation':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property integer $organization_id
 */
class Cooperation extends CActiveRecord
{
    const SOURCE_INTERNATIONAL = 1;
    const SOURCE_PUBLIC = 2;
    const SOURCE_GOVERNMENT = 3;
    const SOURCE_BUSINESS = 4;

    const TYPE_PROJECTS_IMPLEMENTATION = 1;
    const TYPE_DOCUMENTATION_IMPLEMENTATION = 2;
    const TYPE_EVENT_MANAGEMENT = 3;
    const TYPE_EVENT_IMPLEMENTATION = 4;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Cooperation the static model class
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
        return 'org_cooperation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('link, description, source, type, email', 'required'),
            array('source, type', 'numerical', 'integerOnly'=>true),
            array('link, email, contact_name, website', 'length', 'max'=>128),
            array('linkOrganization', 'safe'),
            array('source', 'in', 'range' => array(
                self::SOURCE_INTERNATIONAL, self::SOURCE_PUBLIC,
                self::SOURCE_GOVERNMENT, self::SOURCE_BUSINESS,
            )),
            array('type', 'in', 'range' => array(
                self::TYPE_PROJECTS_IMPLEMENTATION, self::TYPE_DOCUMENTATION_IMPLEMENTATION,
                self::TYPE_EVENT_MANAGEMENT, self::TYPE_EVENT_IMPLEMENTATION,
            )),
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
            ),
            array('email', 'email'),
            array('website', 'url'),

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
            'linkOrganization' => array(self::BELONGS_TO, 'Organization', 'link_organization_id'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'link' => 'Связь',
            'linkOrganization' => 'Связанная Организация',
            'description' => 'Описание',
            'create_time' => 'Время Создания',
            'organization_id' => 'Организация',
            'source' => 'Уровень Сотрудничества',
            'type' => 'Вид Сотрудничества',
            'logo' => 'Логотип Организации',
            'email' => 'Емейл',
            'contact_name' => 'Контактное Лицо',
            'website' => 'Сайт',
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
        // Set link to Organization name.
        if (!empty($this->linkOrganization)) {
            $this->linkOrganization = Organization::model()->findByPk($this->linkOrganization);
            $this->link = $this->linkOrganization->name;
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

            // Set default logo.
            if (empty($this->logo)) {
                $this->logo = 'placeholder.jpg';
            }
        }

        return parent::beforeSave();
    }
}
