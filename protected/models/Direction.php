<?php

/**
 * This is the model class for table "org_direction".
 *
 * The followings are the available columns in table 'org_direction':
 * @property integer $id
 * @property string $name
 */
class Direction extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Direction the static model class
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
	    $name = preg_match("/dbname=([^;]*)/", $this->dbConnection->connectionString, $matches);
	    return $matches[1].'.org_direction';
	    //return 'org_direction';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organizations' => array(
                self::MANY_MANY,
                'Organization',
                'org_organization_direction(direction_id, organization_id)',
            ),
            'organizationsList' => array(
                self::MANY_MANY,
                'Organization',
                'org_organization_direction(direction_id, organization_id)',
                'limit' => 3,
            ),
            'catorganizations' => array(self::MANY_MANY, 'Catorganization', 'org_catorganization_direction(direction_id, catorganization_id)',),
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

	public function getLimitedOrgList($limit = 3) {
		return $this->organizations(array('limit'=>$limit));
	}
}
