<?php

/**
 * This is the model class for table "org_catorganization".
 *
 * The followings are the available columns in table 'org_catorganization':
 * @property integer $id
 * @property string $name
 * @property string $registration_date
 * @property string $address
 * @property integer $address_id
 * @property integer $city_id
 * @property integer $region_id
 * @property string $chief_fio
 * @property string $registration_num
 * @property string $phone
 * @property string $website
 * @property string $email
 * @property integer $organization_id
 * @property integer $is_legal
 * @property integer $action_area
 * @property string $directions_more
 * @property string $logo
 * @property integer $is_branch
 * @property string $branch_master
 * @property integer $is_verified
 *
 * The followings are the available model relations:
 * @property CatorganizationDirection[] $catorganizationDirections
 */
class Catorganization extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Catorganization the static model class
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
        return 'org_catorganization';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, registration_date, address', 'required'),
            array('address_id, city_id, region_id, organization, is_legal, action_area, is_branch, is_verified', 'numerical', 'integerOnly'=>true),
            array('name, address, chief_fio, registration_num, phone, website, email, directions_more, logo, branch_master', 'length', 'max'=>128),

            // array('name', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'directions' => array(self::MANY_MANY, 'Direction', 'org_catorganization_direction(catorganization_id, direction_id)'),
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
            'name' => 'Название',
            'registration_date' => 'Дата Регистрации',
            'address' => 'Точный Адрес',
            'address_id' => 'Адрес',
            'city_id' => 'Город',
            'region_id' => 'Область',
            'chief_fio' => 'ФИО Главы',
            'registration_num' => 'Регистрационный Номер',
            'phone' => 'Номер Телефона',
            'website' => 'Сайт',
            'email' => 'Емейл',
            'organization_id' => 'Организация',
            'is_legal' => 'Легальная',
            'action_area' => 'Область Действий',
            'directions_more' => 'Дополнительные Направления',
            'logo' => 'Лого',
            'is_branch' => 'Является Веткой Организации',
            'branch_master' => 'Название Главной Организации',
            'is_verified' => 'Проверенно',
            'organization' => 'Связанная Организация',
            'directions' => 'Направления',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        return false;

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('registration_date',$this->registration_date,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('address_id',$this->address_id);
        $criteria->compare('city_id',$this->city_id);
        $criteria->compare('region_id',$this->region_id);
        $criteria->compare('chief_fio',$this->chief_fio,true);
        $criteria->compare('registration_num',$this->registration_num,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('website',$this->website,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('organization_id',$this->organization_id);
        $criteria->compare('is_legal',$this->is_legal);
        $criteria->compare('action_area',$this->action_area);
        $criteria->compare('directions_more',$this->directions_more,true);
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('is_branch',$this->is_branch);
        $criteria->compare('branch_master',$this->branch_master,true);
        $criteria->compare('is_verified',$this->is_verified);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
