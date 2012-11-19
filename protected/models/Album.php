<?php

/**
 * This is the model class for table "{{album}}".
 *
 * The followings are the available columns in table '{{album}}':
 * @property integer $id
 * @property string $name
 * @property integer $organization_id
 *
 * The followings are the available model relations:
 * @property Organization $organization
 * @property AlbumImage[] $albumImages
 */
class Album extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Album the static model class
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
        return 'org_album';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>128),

            array('id, name, organization_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'images' => array(self::MANY_MANY, 'Image', 'org_album_image(album_id, image_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Имя',
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
        $criteria->compare('organization_id',$this->organization_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
