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
            array('link, description', 'required', 'on' => 'insert, update'),
            array('link', 'length', 'max'=>128, 'on' => 'insert, update'),
            array('linkOrganization', 'safe', 'on' => 'insert, update'),
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
        // Save link organization name.
        if (empty($this->linkOrganization)) {
            // Restore relation.
            if (!$this->isNewRecord) {
                $originalModel = Partnership::model()->findByPk($this->id);
                $this->linkOrganization = $originalModel->linkOrganization;
            }
        } else {
            $originalLink = $this->linkOrganization;

            // Try to convert PK to relation object.
            if (!($this->linkOrganization instanceof Organization)) {
                $this->linkOrganization = Organization::model()->findByPk($this->linkOrganization);
            }

            // If valid model found, save it's name.
            if ($this->linkOrganization instanceof Organization) {
                $this->link = $this->linkOrganization->name;
            // If still not organization model, save only name.
            } else {
                $this->link = $originalLink;
                $this->linkOrganization = null;
            }
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
