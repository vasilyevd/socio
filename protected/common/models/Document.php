<?php

/**
 * This is the model class for table "org_document".
 *
 * The followings are the available columns in table 'org_document':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $doc_date
 * @property integer $geography
 * @property string $registration_num
 * @property integer $docauthor_id
 * @property integer $doctype_id
 * @property string $publication_date
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property Docauthor $docauthor
 * @property Doctype $doctype
 */
class Document extends CActiveRecord
{
    const GEOGRAPHY_INTERNATIONAL = 1;
    const GEOGRAPHY_NATIONAL = 2;
    const GEOGRAPHY_CITY = 3;
    const GEOGRAPHY_REGIONAL = 4;
    const GEOGRAPHY_COUNTRY = 5;
    const GEOGRAPHY_DISTRICT = 6;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Document the static model class
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
        return 'org_document';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(
                'doctype',
                'application.components.validators.ExistRelationValidator',
            ),
            array('docauthor', 'docauthorRelationValidator'),
            array('name, content, doc_date, geography', 'required'),
            array('geography, is_active', 'numerical', 'integerOnly'=>true),
            array('name, registration_num', 'length', 'max'=>128),
            array('doc_date, publication_date', 'date', 'format' => 'yyyy-MM-dd'),
            array('geography', 'in', 'range' => array(
                self::GEOGRAPHY_INTERNATIONAL, self::GEOGRAPHY_NATIONAL,
                self::GEOGRAPHY_CITY, self::GEOGRAPHY_REGIONAL,
                self::GEOGRAPHY_COUNTRY, self::GEOGRAPHY_DISTRICT,
            )),
            array('is_active', 'boolean'),
            array('content', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),

            // array('id, name, content, doc_date, geography, registration_num, docauthor_id, doctype_id, publication_date, is_active', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'docauthor' => array(self::BELONGS_TO, 'Docauthor', 'docauthor_id'),
            'doctype' => array(self::BELONGS_TO, 'Doctype', 'doctype_id'),
        );
    }

    /**
     * @return array behaviors for current model.
     */
    public function behaviors()
    {
        return array(
            // Advanced relations.
            'EActiveRecordRelationBehavior' => array(
                'class' => 'application.components.behaviors.EActiveRecordRelationBehavior'
            ),
            'TabularBehavior' => array(
                'class' => 'application.components.behaviors.TabularBehavior',
                'relations' => array(
                    array('name' => 'docauthor'),
                ),
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
            'content' => 'Содержимое',
            'doc_date' => 'Дата Документа',
            'geography' => 'География Документа',
            'registration_num' => 'Регистрационный Номер',
            'docauthor' => 'Автор',
            'doctype' => 'Вид Документа',
            'publication_date' => 'Дата Публикации',
            'is_active' => 'Активен',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('name',$this->name,true);
        $criteria->compare('doc_date',$this->doc_date,true);
        $criteria->compare('geography',$this->geography);

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
        // Allow null date database field.
        if (empty($this->publication_date)) {
            $this->publication_date = null;
        }

        return parent::beforeSave();
    }

    /**
     * Transforms attribute data to relation and validates it.
     * Can be used as 'TabularBehavior' handler.
     * @param string $attribute the attribute being validated.
     * @param array $params the list of validation parameters.
     */
    public function docauthorRelationValidator($attribute, $params)
    {
        $relation = null;
        $valid = true;

        if (!empty($this->$attribute)) {
            if (is_object($this->$attribute)) {
                $model = $this->$attribute;
            } else {
                $model = Docauthor::model()->findByAttributes(array(
                    'name' => $this->$attribute,
                ));
                if (is_null($model)) {
                    $model = new Docauthor;
                    $model->name = $this->$attribute;
                }
            }

            $relation = $model;
            $valid = $model->validate() && $valid;
        }

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
    }
}
