<?php

/**
 * This is the model class for table "{{verification}}".
 *
 * The followings are the available columns in table '{{verification}}':
 * @property integer $id
 * @property integer $organization_id
 * @property string $description
 * @property string $documents
 * @property string $name
 * @property string $phone_num
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Organization $organization
 */
class Verification extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Verification the static model class
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
        return 'org_verification';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('organization_id, description, documents, name, phone_num, email', 'required'),
            array('organization_id', 'numerical', 'integerOnly'=>true),
            array('name, phone_num, email', 'length', 'max'=>128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, organization_id, description, documents, name, phone_num, email', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'organization_id' => 'Organization',
            'description' => 'Description',
            'documents' => 'Documents',
            'name' => 'Name',
            'phone_num' => 'Phone Num',
            'email' => 'Email',
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
        $criteria->compare('organization_id',$this->organization_id);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('documents',$this->documents,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('phone_num',$this->phone_num,true);
        $criteria->compare('email',$this->email,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
