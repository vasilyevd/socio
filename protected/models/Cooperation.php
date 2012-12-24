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
            array('link, description', 'required'),
            array('link', 'length', 'max'=>128),
            array('linkOrganization', 'safe'),

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
        // Save link organization name.
        if (empty($this->linkOrganization)) {
            // Restore relation.
            if (!$this->isNewRecord) {
                $originalModel = Cooperation::model()->findByPk($this->id);
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
        }

        return parent::beforeSave();
    }
}
