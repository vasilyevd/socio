<?php

/**
 * This is the model class for table "org_mmtag".
 *
 * The followings are the available columns in table 'org_mmtag':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property MassmediaMmtag[] $massmediaMmtags
 */
class Mmtag extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Mmtag the static model class
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
        return 'org_mmtag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>128),

            // array('id, name', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'massmedias' => array(self::MANY_MANY, 'Massmedia', 'org_massmedia_mmtag(mmtag_id, massmedia_id)'),
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

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Retrieves tag models for selected organization.
     * @param int $organizationId the ID of organization model.
     * @return array of tag models.
     */
    public static function getTagsForOrganization($organizationId)
    {
        $criteria = new CDbCriteria;

        $criteria->with = 'massmedias';
        $criteria->compare('massmedias.organization_id', $organizationId);

        return Mmtag::model()->findAll($criteria);
    }
}
