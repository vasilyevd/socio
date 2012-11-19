<?php

/**
 * This is the model class for table "{{problem}}".
 *
 * The followings are the available columns in table '{{problem}}':
 * @property integer $id
 * @property integer $group
 * @property string $name
 *
 * The followings are the available model relations:
 * @property OrganizationProblem[] $organizationProblems
 */
class Problem extends CActiveRecord
{
    const GROUP_SOME = 1;
    const GROUP_ANOTHER = 2;
    const GROUP_ONEMORE = 3;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Problem the static model class
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
        return 'org_problem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('group, name', 'required'),
            array('group', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, group, name', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'group' => 'Group',
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
        $criteria->compare('group',$this->group);
        $criteria->compare('name',$this->name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
