<?php

/**
 * This is the model class for table "org_donor".
 *
 * The followings are the available columns in table 'org_donor':
 * @property integer $id
 * @property string $name
 * @property string $country
 * @property string $website
 * @property string $email
 * @property string $logo
 *
 * The followings are the available model relations:
 * @property Donorship[] $donorships
 */
class Donor extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Donor the static model class
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
        return 'org_donor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, description, country, website, email, logo', 'required'),
            array('name, country, website, email, logo', 'length', 'max'=>128),

            // array('id, name, country, website, email, logo', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'donorships' => array(self::HAS_MANY, 'Donorship', 'donor_id'),
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
            'name' => 'Name',
            'description' => 'Description',
            'country' => 'Country',
            'website' => 'Website',
            'email' => 'Email',
            'logo' => 'Logo',
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
        $criteria->compare('country',$this->country,true);
        $criteria->compare('website',$this->website,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('logo',$this->logo,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
