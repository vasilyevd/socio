<?php

/**
 * This is the model class for table "org_company".
 *
 * The followings are the available columns in table 'org_company':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Massmedia[] $massmedias
 */
class Company extends CActiveRecord
{
    const TYPE_INFORMATIONAL = 1;
    const TYPE_ADVERTISEMENT = 2;
    const TYPE_LEGAL = 3;
    const TYPE_PR = 4;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Company the static model class
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
        return 'org_company';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type, description, massmedias', 'required'),
            array('name', 'length', 'max'=>128),
            array('type', 'numerical', 'integerOnly'=>true),
            array('type', 'in', 'range' => array(
                self::TYPE_INFORMATIONAL, self::TYPE_ADVERTISEMENT,
                self::TYPE_LEGAL, self::TYPE_PR,
            )),

            // array('id, name, type, description', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'massmedias' => array(self::HAS_MANY, 'Massmedia', 'company_id'),
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
            'name' => 'Название',
            'type' => 'Тип',
            'description' => 'Описание',
            'organization_id' => 'Организация',
            'massmedias' => 'Элементы СМИ',
            'min_date' => 'Минимальная Дата',
            'max_date' => 'Максимальная Дата',
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
        $criteria->compare('type',$this->type);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Finds homeless Massmedia elements.
     */
    public function getHomelessMassmedia()
    {
        if ($this->isNewRecord) {
            $models = Massmedia::model()->findAll(
                'organization_id=:organization_id AND company_id IS NULL',
                array('organization_id' => $_GET['org'])
            );
        } else {
            $models = Massmedia::model()->findAll(
                'organization_id=:organization_id AND (company_id=:company_id OR company_id IS NULL)',
                array('organization_id' => $this->organization->id, ':company_id' => $this->id)
            );
        }

        return $models;
    }

    /**
     * Updates 'min_date' and 'max_date' based on Massmedia time and date.
     * @param string $date the main date to compare with.
     * @param string $fallbackTime the datetime will be used if $date is empty.
     * @cascadeSearch boolean if search on 'massmedias' relation needed.
     */
    public function updateDateRange($date, $fallbackTime, $cascadeSearch = false)
    {
        // Extract date from 'create_time'.
        if (empty($date)) {
            $date = date('Y-m-d', strtotime($fallbackTime));
        }

        // Convert to timestamp.
        $compareTime = strtotime($date);
        $minTime = strtotime($this->min_date);
        $maxTime = strtotime($this->max_date);

        // Find new range.
        if ($compareTime < $minTime) {
            $this->min_date = $date;
        }
        if ($compareTime > $maxTime) {
            $this->max_date = $date;
        }

        if ($cascadeSearch) {
            if ($compareTime == $minTime) {
                foreach ($this->massmedias as $m) {
                    $this->updateDateRange($m->publication_date, $m->create_time);
                }
            }
            // Etc.
        }
    }
}
