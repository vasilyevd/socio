<?php

/**
 * This is the model class for table "org_support".
 *
 * The followings are the available columns in table 'org_support':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property integer $organization_id
 */
class Support extends CActiveRecord
{
    const SOURCE_INTERNATIONAL = 1;
    const SOURCE_CHARITABLE = 2;
    const SOURCE_GOVERNMENT = 3;
    const SOURCE_BUSINESS = 4;

    const TYPE_ADMINISTRATIVE = 1;
    const TYPE_PROJECT_SUPPORT = 2;
    const TYPE_ECONOMIC_ACTIVITY = 3;
    const TYPE_TOOLS_AND_EQUIPMENT = 4;
    const TYPE_FINANCIAL_EDUCATION = 5;

    const FUNDS_10K = 1;
    const FUNDS_20K = 2;
    const FUNDS_80K = 3;
    const FUNDS_OTHER = 4;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Support the static model class
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
        return 'org_support';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('link, description, source, type, delivery_year, funds', 'required'),
            array('source, type, delivery_year, funds, funds_specific', 'numerical', 'integerOnly'=>true),
            array('link', 'length', 'max'=>128),
            array('linkOrganization', 'safe'),
            array('source', 'in', 'range' => array(
                self::SOURCE_INTERNATIONAL, self::SOURCE_CHARITABLE,
                self::SOURCE_GOVERNMENT, self::SOURCE_BUSINESS,
            )),
            array('type', 'in', 'range' => array(
                self::TYPE_ADMINISTRATIVE, self::TYPE_PROJECT_SUPPORT,
                self::TYPE_ECONOMIC_ACTIVITY, self::TYPE_TOOLS_AND_EQUIPMENT,
                self::TYPE_FINANCIAL_EDUCATION,
            )),
            array('funds', 'in', 'range' => array(
                self::FUNDS_10K, self::FUNDS_20K,
                self::FUNDS_80K, self::FUNDS_OTHER,
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
            'source' => 'Источник Донорства',
            'type' => 'Целевое Назначение',
            'logo' => 'Логотип Организации',
            'delivery_year' => 'Год Вручения',
            'funds' => 'Средства',
            'funds_specific' => 'Средства Конкретнее',
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
        // Find new link attributes.
        if (is_string($this->linkOrganization) && ctype_digit($this->linkOrganization)) {
            $this->linkOrganization = Organization::model()->findByPk($this->linkOrganization);
            $this->link = $this->linkOrganization->name;
        }
        // Restore empty link attributes on update.
        if (!$this->isNewRecord && empty($this->link)) {
            $originalModel = Support::model()->findByPk($this->id);
            $this->linkOrganization = $originalModel->linkOrganization;
            $this->link = $originalModel->link;
        }

        // Don't allow empty 'funds_specific' on funds 'FUNDS_OTHER'.
        if ($this->funds == self::FUNDS_OTHER) {
            if (empty($this->funds_specific)) {
                $this->funds = null;
            }
        // Blank 'funds_specific', if selected regular 'funds'.
        } else {
            $this->funds_specific = null;
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
