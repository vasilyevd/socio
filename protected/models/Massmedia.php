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
            array('title, content, tags, links', 'required'),
            array('title', 'length', 'max'=>128),
            array('content','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),

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
            'links' => array(self::HAS_MANY, 'Mmlink', 'massmedia_id'),
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
            'title' => 'Титул',
            'content' => 'Содержимое',
            'create_time' => 'Время Создания',
            'organization_id' => 'Организация',
            'tags' => 'Теги',
            'links' => 'Ссылки',
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
     * Finds and creates models from tabular input.
     * @param $tabularInput for current model.
     * @return boolean whether models are valid.
     */
    public function tagsTabular($tabularInput)
    {
        $modelArray = array();

        if (!empty($tabularInput)) {
            $tagsNames = explode(',', $tabularInput);

            // Create new models if don't exists.
            foreach ($tagsNames as $n) {
                $model = Mmtag::model()->find(
                    'name=:name',
                    array(':name' => $n)
                );
                if ($model === null) {
                    $model = new Mmtag;
                }
                $model->name = $n;

                $modelArray[] = $model;
            }
        }

        $this->tags = $modelArray;

        // Validation.
        $valid = true;
        foreach ($this->tags as $item) {
            $valid = $item->validate() && $valid;
        }
        return $valid;
    }

    /**
     * Finds and creates models from tabular input.
     * @param $tabularInput for current model.
     * @return boolean whether models are valid.
     */
    public function linksTabular($tabularInput)
    {
        $modelArray = array();

        foreach ($tabularInput as $attributes) {
            $model = Mmlink::model()->findByPk($attributes['id']);
            if ($model === null) {
                $model = new Mmlink;
            }
            $model->attributes = $attributes;
            // Don't forget foreign key constraint.
            // $model->massmedia = $this;

            // Don't include empty names elements.
            if (!empty($model->name)) {
                $modelArray[] = $model;
            }
        }

        $this->links = $modelArray;

        // Validation.
        $valid = true;
        foreach ($this->links as $item) {
            $valid = $item->validate() && $valid;
        }
        return $valid;
    }

    /**
     * Implodes tags relation array to plain string.
     */
    public function tagsToString()
    {
        if (empty($this->tags)) {
            $this->tags = '';
        } elseif (!is_string($this->tags)) {
            $this->tags = implode(
                ',',
                CHtml::listData($this->tags, 'id', 'name')
            );
        }
    }
}
