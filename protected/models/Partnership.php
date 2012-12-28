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
            array('link, description, source, type, email', 'required', 'on' => 'insert, update'),
            array('source, type', 'numerical', 'integerOnly'=>true, 'on' => 'insert, update'),
            array('link, email, contact_name, website', 'length', 'max'=>128, 'on' => 'insert, update'),
            array('linkOrganization', 'safe', 'on' => 'insert, update'),
            array('source', 'in', 'range' => array(
                Cooperation::SOURCE_INTERNATIONAL, Cooperation::SOURCE_PUBLIC,
                Cooperation::SOURCE_GOVERNMENT, Cooperation::SOURCE_BUSINESS,
            ), 'on' => 'insert, update'),
            array('type', 'in', 'range' => array(
                Cooperation::TYPE_SOME, Cooperation::TYPE_OTHER,
                Cooperation::TYPE_MORE,
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

            array('verification_description, files', 'safe', 'on' => 'insert, updateVerification'),

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
            'source' => 'Источник',
            'type' => 'Тип',
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
        // Find new link attributes.
        if (is_string($this->linkOrganization) && ctype_digit($this->linkOrganization)) {
            $this->linkOrganization = Organization::model()->findByPk($this->linkOrganization);
            $this->link = $this->linkOrganization->name;
        }
        // Restore empty link attributes on update.
        if (!$this->isNewRecord && empty($this->link)) {
            $originalModel = Partnership::model()->findByPk($this->id);
            $this->linkOrganization = $originalModel->linkOrganization;
            $this->link = $originalModel->link;
        }

        // Relations with new models handler 'HAS_MANY' and 'MANY_MANY'.
        // Find or create objects and validate.
        $this->filesTabular();

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

            // Default verified status.
            $this->verified = false;

            // Set default logo.
            if (empty($this->logo)) {
                $this->logo = 'placeholder.jpg';
            }
        }

        // Relations with new models handler 'HAS_MANY' and 'MANY_MANY'.
        // Save new models.
        foreach ($this->files as $m) $m->save();

        return parent::beforeSave();
    }

    /**
     * Relations with new models handler.
     * Finds, creates and validates models from tabular input.
     */
    public function filesTabular()
    {
        $valid = true;
        $modelArray = array();

        // Upload handler.
        $uploads = CUploadedFile::getInstances($this, 'files');
        foreach ($uploads as $file) {
            $model = new Partfile;

            $model->name = $file;

            $valid = $model->validate() && $valid;
            $modelArray[] = $model;
        }

        $this->files = array_merge($this->files, $modelArray);
        if (!$valid) $this->addError('files', 'Неверно задано поле ' . $this->getAttributeLabel('files'));
    }
}
