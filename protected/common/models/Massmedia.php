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
    const CATEGORY_PUBLICATION = 1;
    const CATEGORY_PRESS_ANNOUNCEMENT = 2;
    const CATEGORY_PRESS_CONFERENCE = 3;
    const CATEGORY_PUBLIC_SPEAKING = 4;
    const CATEGORY_TV_PROJECT = 5;
    const CATEGORY_RADIO_PROJECT = 6;
    const CATEGORY_SOCIAL_ADVERTISING = 7;

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
            array(
                'organization',
                'application.components.validators.ExistRelationValidator',
                'on' => 'insert',
            ),
            array('tags', 'tagsRelationValidator'),
            array('links', 'linksRelationValidator'),
            array('files', 'filesRelationValidator'),
            array('title, content, tags, links, category, direction, files', 'required'),
            array('title', 'length', 'max'=>128),
            array('content','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            array('category', 'in', 'range' => array(
                self::CATEGORY_PUBLICATION, self::CATEGORY_PRESS_ANNOUNCEMENT,
                self::CATEGORY_PRESS_CONFERENCE, self::CATEGORY_PUBLIC_SPEAKING,
                self::CATEGORY_TV_PROJECT, self::CATEGORY_RADIO_PROJECT,
                self::CATEGORY_SOCIAL_ADVERTISING,
            )),
            array('direction', 'boolean'),
            array('publication_date', 'date', 'format'=>'yyyy-MM-dd'),

            array('title, tags', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'tags' => array(self::MANY_MANY, 'Mmtag', 'org_massmedia_mmtag(massmedia_id, mmtag_id)'),
            'links' => array(self::HAS_MANY, 'Mmlink', 'massmedia_id'),
            'linksGeneral' => array(
                self::HAS_MANY,
                'Mmlink',
                'massmedia_id',
                'condition' => 'type=' . Mmlink::TYPE_GENERAL,
            ),
            'linksGeneralCount' => array(
                self::STAT,
                'Mmlink',
                'massmedia_id',
                'condition' => 'type=' . Mmlink::TYPE_GENERAL,
            ),
            'linksYoutube' => array(
                self::HAS_MANY,
                'Mmlink',
                'massmedia_id',
                'condition' => 'type=' . Mmlink::TYPE_YOUTUBE,
            ),
            'linksYoutubeCount' => array(
                self::STAT,
                'Mmlink',
                'massmedia_id',
                'condition' => 'type=' . Mmlink::TYPE_YOUTUBE,
            ),
            'files' => array(self::HAS_MANY, 'Mmfile', 'massmedia_id'),
            'filesCount' => array(self::STAT, 'Mmfile', 'massmedia_id'),
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
            'TabularBehavior' => array(
                'class' => 'application.components.behaviors.TabularBehavior',
                'relations' => array(
                    array('name' => 'tags'),
                    array('name' => 'links', 'delete' => true),
                    array('name' => 'files', 'delete' => true),
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
            'title' => 'Титул',
            'content' => 'Содержимое',
            'create_time' => 'Время Создания',
            'organization_id' => 'Организация',
            'tags' => 'Теги',
            'links' => 'Ссылки',
            'category' => 'Категория',
            'direction' => 'Направление',
            'files' => 'Файлы',
            'publication_date' => 'Дата Публикации',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->with = array(
            'company',
            'linksGeneralCount',
            'linksYoutubeCount',
            'filesCount',

            'tags' => array('select' => false),
            'organization' => array('select' => false),
        );

        if (!empty($this->tags)) {
            $criteria->with['tags']['together'] = true;
            $criteria->addInCondition('tags.id', $this->tags);
        }

        $criteria->compare('organization.id', $this->organization);

        $criteria->compare('t.title', $this->title, true);
        $criteria->compare('t.category', $this->category);
        $criteria->compare('t.direction', $this->direction);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * This is invoked before the record is deleted.
     */
    public function beforeDelete()
    {
        // Upload handler.
        foreach ($this->files as $m) $m->delete();

        return parent::beforeDelete();
    }

    /**
     * This is invoked after the record is deleted.
     */
    public function afterDelete()
    {
        parent::afterDelete();

        // Update date ranges ('min_date' and 'max_date') for company.
        if (!empty($this->company)) {
            $this->company->updateDateRange();
        }
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

        // Allow null date database field.
        if (empty($this->publication_date)) {
            $this->publication_date = null;
        }

        return parent::beforeSave();
    }

    /**
     * This is invoked after the record is saved.
     */
    public function afterSave()
    {
        parent::afterSave();

        // Update date ranges ('min_date' and 'max_date') for company.
        if (!empty($this->company)) {
            $this->company->updateDateRange();
        }
    }

    /**
     * Transforms attribute data to relation and validates it.
     * Can be used as 'TabularBehavior' handler.
     * @param string $attribute the attribute being validated.
     * @param array $params the list of validation parameters.
     */
    public function tagsRelationValidator($attribute, $params)
    {
        $relation = array();
        $valid = true;

        // Transform tag string to tabular data array.
        if (is_string($this->$attribute)) {
            $this->$attribute = explode(',', $this->$attribute);
        }

        foreach ($this->$attribute as $data) {
            if (is_object($data)) {
                $model = $data;
            } else {
                $model = Mmtag::model()->findByAttributes(array(
                    'name' => $data,
                ));
                if (is_null($model)) {
                    $model = new Mmtag;
                    $model->name = $data;
                }
            }

            $relation[] = $model;
            $valid = $model->validate() && $valid;
        }

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
    }

    /**
     * Transforms attribute data to relation and validates it.
     * Can be used as 'TabularBehavior' handler.
     * @param string $attribute the attribute being validated.
     * @param array $params the list of validation parameters.
     */
    public function linksRelationValidator($attribute, $params)
    {
        $relation = array();
        $valid = true;

        foreach ($this->$attribute as $data) {
            if (is_object($data)) {
                $model = $data;
            } else {
                $model = Mmlink::model()->findByAttributes(array(
                    'id' => $data['id'],
                    'massmedia_id' => $this->id,
                ));
                if (is_null($model)) {
                    $model = new Mmlink;
                }

                $model->attributes = $data;
            }

            $relation[] = $model;
            $valid = $model->validate() && $valid;
        }

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
    }

    /**
     * Transforms attribute data to relation and validates it.
     * Can be used as 'TabularBehavior' handler.
     * @param string $attribute the attribute being validated.
     * @param array $params the list of validation parameters.
     */
    public function filesRelationValidator($attribute, $params)
    {
        $relation = array();
        $valid = true;

        foreach ($this->$attribute as $i => $data) {
            if (is_object($data)) {
                $model = $data;
            } else {
                $model = Mmfile::model()->findByAttributes(array(
                    'id' => $data['id'],
                    'massmedia_id' => $this->id,
                ));
                if (is_null($model)) {
                    $model = new Mmfile;
                }

                $model->attributes = $data;
                // Upload handler.
                $model->name = CUploadedFile::getInstance($model, "[$i]name");
            }

            $relation[] = $model;
            $valid = $model->validate() && $valid;
        }

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
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
