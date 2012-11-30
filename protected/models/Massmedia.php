<?php

/**
 * This is the model class for table "org_massmedia".
 *
 * The followings are the available columns in table 'org_massmedia':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $create_time
 * @property integer $organization_id
 *
 * The followings are the available model relations:
 * @property Organization $organization
 * @property MassmediaMmtag[] $massmediaMmtags
 */
class Massmedia extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Massmedia the static model class
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
        return 'org_massmedia';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title, content, tags', 'required'),
            array('title', 'length', 'max'=>128),

            // array('id, title, content, create_time, organization_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'tags' => array(self::MANY_MANY, 'Mmtag', 'org_massmedia_mmtag(massmedia_id, mmtag_id)'),
        );
    }

    /**
     * @return array behaviors for current model.
     */
    public function behaviors()
    {
        return array(
            // Advanced relations
            'EAdvancedArBehavior' => array(
                'class' => 'application.components.behaviors.EAdvancedArBehavior'
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
            'title' => 'Титул',
            'content' => 'Содержимое',
            'create_time' => 'Время Создания',
            'organization_id' => 'Организация',
            'tags' => 'Теги',
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
        $criteria->compare('title',$this->title,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('organization_id',$this->organization_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave()
    {
        if ($this->isNewRecord) {
            // Save current time.
            $this->create_time = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    /**
    * Implode relation array to plain string.
    * @param array $relation the list of relation models.
    * @param string $attribute name of relation attribute.
    * @param string $glue the combine string.
    * @return string relation string, elements separated by $glue.
    */
    public static function relationToString($relation, $attribute, $glue)
    {
        if (empty($relation)) {
            return '';
        } elseif (is_string($relation)) {
            return $relation;
        } else {
            return implode($glue, CHtml::listData($relation, 'id', $attribute));
        }
    }

    /**
    * Create and save all relations for this model from string.
    * @param string $relationString the relation string, separated by $glue.
    * @param string $modelName the name of relation model.
    * @param string $attribute name of relation attribute.
    * @param string $glue the combine string.
    * @return array list of relation models.
    */
    public static function stringToRelation($relationString, $modelName, $attribute, $glue)
    {
        $relationArray = array();

        if (!empty($relationString)) {
            $relationNames = explode(',', $relationString);

            // Create new models if don't exists.
            foreach ($relationNames as $n) {
                $relation = $modelName::model()->find(
                    $attribute . '=:attribute',
                    array(':attribute' => $n)
                );
                if ($relation === null) {
                    $relation = new $modelName;
                    $relation->$attribute = $n;
                    $relation->save();
                }
                $relationArray[] = $relation;
            }
        }

        return $relationArray;
    }
}
