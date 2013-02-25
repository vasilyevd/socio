<?php

/**
 * This is the model class for table "org_govprofile".
 *
 * The followings are the available columns in table 'org_govprofile':
 * @property integer $id
 * @property integer $organization_id
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property Govorganization $organization
 * @property Govorganization $parent
 */
class Govprofile extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Govprofile the static model class
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
        return 'org_govprofile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(
                'parent',
                'application.components.validators.ExistRelationValidator',
            ),

            // array('id, organization_id, parent_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Govorganization', 'organization_id'),
            'parent' => array(self::BELONGS_TO, 'Govorganization', 'parent_id'),
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
            'organization_id' => 'Организация',
            'parent' => 'Организация Предок',
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
        $criteria->compare('parent_id',$this->parent_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
