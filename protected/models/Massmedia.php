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
     * This is invoked before the record is validated.
     * @return boolean whether the record is valid.
     */
    public function beforeValidate()
    {
        // Relations with new models handler 'HAS_MANY' and 'MANY_MANY'.
        // Find or create objects and validate.
        $this->tagsTabular();
        $this->linksTabular();
        $this->filesTabular();

        return parent::beforeValidate();
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

        // Relations with new models handler 'HAS_MANY' and 'MANY_MANY'.
        // Save new models.
        foreach ($this->tags as $m) $m->save();
        foreach ($this->links as $m) $m->save();
        foreach ($this->files as $m) $m->save();

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

        // Relations with new models handler 'HAS_MANY'.
        // Delete old models.
        $deleteModels = Mmlink::model()->findAllByAttributes(array('massmedia_id' => null));
        foreach ($deleteModels as $m) $m->delete();
        $deleteModels = Mmfile::model()->findAllByAttributes(array('massmedia_id' => null));
        foreach ($deleteModels as $m) $m->delete();
    }

    /**
     * Relations with new models handler.
     * Finds, creates and validates models from tabular input.
     */
    public function tagsTabular()
    {
        $valid = true;
        $modelArray = array();

        if (!empty($this->tags)) {
            $tagsNames = explode(',', $this->tags);

            foreach ($tagsNames as $n) {
                $model = Mmtag::model()->find(
                    'name=:name',
                    array(':name' => $n)
                );
                if ($model === null) {
                    $model = new Mmtag;
                }

                $model->name = $n;

                $valid = $model->validate() && $valid;
                $modelArray[] = $model;
            }
        }

        $this->tags = $modelArray;
        if (!$valid) $this->addError('tags', 'Неверно задано поле ' . $this->getAttributeLabel('tags'));
    }

    /**
     * Relations with new models handler.
     * Finds, creates and validates models from tabular input.
     */
    public function linksTabular()
    {
        $valid = true;
        $modelArray = array();

        foreach ($this->links as $attributes) {
            $model = Mmlink::model()->findByPk($attributes['id']);
            if ($model === null) {
                $model = new Mmlink;
            }

            $model->attributes = $attributes;

            $valid = $model->validate() && $valid;
            $modelArray[] = $model;
        }

        $this->links = $modelArray;
        if (!$valid) $this->addError('links', 'Неверно задано поле ' . $this->getAttributeLabel('links'));
    }

    /**
     * Relations with new models handler.
     * Finds, creates and validates models from tabular input.
     */
    public function filesTabular()
    {
        $valid = true;
        $modelArray = array();

        foreach ($this->files as $i => $attributes) {
            $model = Mmfile::model()->findByPk($attributes['id']);
            if ($model === null) {
                $model = new Mmfile;
            }

            $model->attributes = $attributes;
            // Upload handler.
            $model->name = CUploadedFile::getInstance($model, "[$i]name");

            $valid = $model->validate() && $valid;
            $modelArray[] = $model;
        }

        $this->files = $modelArray;
        if (!$valid) $this->addError('files', 'Неверно задано поле ' . $this->getAttributeLabel('files'));
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
