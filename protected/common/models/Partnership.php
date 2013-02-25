<?php

/**
 * This is the model class for table "org_partnership".
 *
 * The followings are the available columns in table 'org_partnership':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property integer $organization_id
 */
class Partnership extends CActiveRecord
{
    const SOURCE_INTERNATIONAL = 1;
    const SOURCE_PUBLIC = 2;
    const SOURCE_GOVERNMENT = 3;
    const SOURCE_BUSINESS = 4;

    const TYPE_AGENCY = 1;
    const TYPE_NATIONAL = 2;
    const TYPE_GRANT = 3;
    const TYPE_PROGRAM = 4;
    const TYPE_CONTRACT = 5;
    const TYPE_DECLARATIVE = 6;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Partnership the static model class
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
        return 'org_partnership';
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
            array('files', 'filesRelationValidator', 'on' => 'insert, updateVerification'),
            array('link, description, source, type, email', 'required', 'on' => 'insert, update'),
            array('source, type', 'numerical', 'integerOnly'=>true, 'on' => 'insert, update'),
            array('link, email, contact_name, website', 'length', 'max'=>128, 'on' => 'insert, update'),
            array('linkOrganization', 'safe', 'on' => 'insert, update'),
            array('source', 'in', 'range' => array(
                self::SOURCE_INTERNATIONAL, self::SOURCE_PUBLIC,
                self::SOURCE_GOVERNMENT, self::SOURCE_BUSINESS,
            ), 'on' => 'insert, update'),
            array('type', 'in', 'range' => array(
                self::TYPE_AGENCY, self::TYPE_NATIONAL,
                self::TYPE_GRANT, self::TYPE_PROGRAM,
                self::TYPE_CONTRACT, self::TYPE_DECLARATIVE,
            ), 'on' => 'insert, update'),
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
                'on' => 'insert, update',
            ),
            array('email', 'email', 'on' => 'insert, update'),
            array('website', 'url', 'on' => 'insert, update'),

            array('verification_description', 'safe', 'on' => 'insert, updateVerification'),

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
            'files' => array(self::HAS_MANY, 'Partfile', 'partnership_id'),
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
            'source' => 'Уровень Партнерства',
            'type' => 'Статус Партнерства',
            'logo' => 'Логотип Организации',
            'email' => 'Емейл',
            'contact_name' => 'Контактное Лицо',
            'website' => 'Сайт',
            'verified' => 'Проверенно',
            'verification_description' => 'Описание Проверки',
            'files' => 'Файлы',
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
     * This is invoked before the record is deleted.
     */
    public function beforeDelete()
    {
        // Upload handler.
        foreach ($this->files as $m) $m->delete();

        return parent::beforeDelete();
    }

    /**
     * This is invoked before the record is validated.
     */
    public function beforeValidate()
    {
        // In case link Organization model is set, save it's name to link.
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
        // Relations handler.
        foreach ($this->files as $m) $m->save();

        if ($this->isNewRecord) {
            // Save current time.
            $this->create_time = new CDbExpression('NOW()');

            // Default verified status.
            $this->verified = false;

            // Set default logo.
            if (empty($this->logo)) {
                $this->logo = 'placeholder.jpg';
            }
        }

        return parent::beforeSave();
    }

    /**
     * Transforms attribute data to relation and validates it.
     * @param string $attribute the attribute being validated.
     * @param array $params the list of validation parameters.
     */
    public function filesRelationValidator($attribute, $params)
    {
        $relation = array();
        $valid = true;

        // Upload handler.
        $uploads = CUploadedFile::getInstances($this, 'files');
        foreach ($uploads as $file) {
            $model = new Partfile;
            $model->name = $file;

            $relation[] = $model;
            $valid = $model->validate() && $valid;
        }
        $relation = array_merge($this->files, $relation);

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
    }
}
