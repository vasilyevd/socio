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
    const GROUP_LAW = 1;
    const GROUP_EDUCATION = 2;
    const GROUP_SOCIAL_PROBLEMS = 3;
    const GROUP_SOCIETY = 4;
    const GROUP_HEALTH = 5;
    const GROUP_CULTURE = 6;
    const GROUP_GLOBAL_PROBLEMS = 7;
    const GROUP_DISABILITY = 8;
    const GROUP_MEDIA = 9;

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
        return array(
            'organizations' => array(self::MANY_MANY, 'Organization', 'org_organization_problem(problem_id, organization_id)'),
            'organizationsList' => array(
                self::MANY_MANY,
                'Organization',
                'org_organization_problem(problem_id, organization_id)',
                'limit' => 3,
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
