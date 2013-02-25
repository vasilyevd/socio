<?php

/**
 * This is the model class for table "org_infofile".
 *
 * The followings are the available columns in table 'org_infofile':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $preview
 * @property integer $inforequest_id
 * @property integer $group
 *
 * The followings are the available model relations:
 * @property Inforequest $inforequest
 */
class Infofile extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Infofile the static model class.
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name.
     */
    public function tableName()
    {
        return 'org_infofile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, type, preview', 'required'),
            array('type, preview, inforequest_id, group', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, type, preview, inforequest_id, group', 'safe', 'on' => 'search'),
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
            'inforequest' => array(self::BELONGS_TO, 'Inforequest', 'inforequest_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label).
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'preview' => 'Preview',
            'inforequest_id' => 'Inforequest',
            'group' => 'Group',
        );
    }

    /**
     * Retrieves a list of models based on the current filter conditions.
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria=new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('preview', $this->preview);
        $criteria->compare('inforequest_id', $this->inforequest_id);
        $criteria->compare('group', $this->group);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
