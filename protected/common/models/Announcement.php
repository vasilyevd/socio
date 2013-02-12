<?php

/**
 * This is the model class for table "{{announcement}}".
 *
 * The followings are the available columns in table '{{announcement}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $create_time
 * @property integer $publication_time
 * @property integer $status
 * @property integer $organization_id
 * @property integer $author_id
 * @property integer $category
 */
class Announcement extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const CATEGORY_GENERAL = 1;
    const CATEGORY_NEWS = 2;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Announcement the static model class
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
        return 'org_announcement';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title, content, publication_time, status, category', 'required', 'on' => 'insert, update'),
            array('status, category', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>128),
            array('files', 'safe'),
            array('publication_time', 'date', 'format'=>'yyyy-MM-dd HH:mm:ss'),
            array('category', 'in', 'range' => array(
                self::CATEGORY_GENERAL, self::CATEGORY_NEWS,
            )),
            array('status', 'in', 'range' => array(
                self::STATUS_ACTIVE, self::STATUS_INACTIVE,
            )),
            array('content','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),

            array('id, title, content, create_time, publication_time, status, organization_id, author_id, category', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'files' => array(self::HAS_MANY, 'Annfile', 'announcement_id'),
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
            'publication_time' => 'Время Публикации',
            'status' => 'Статус',
            'organization_id' => 'Организация',
            'author_id' => 'Автор',
            'files' => 'Файлы',
            'category' => 'Категория',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        // Relation.
        $criteria->with = array();

        // Relation BELONGS_TO search.
        if (!empty($this->organization)) {
            $criteria->with = array_merge($criteria->with, array(
                'organization',
            ));
            $criteria->compare('organization.id', $this->organization);
        }

        // Check for whole day.
        $criteria->compare('date(t.publication_time)',$this->publication_time);
        $criteria->compare('t.title',$this->title,true);
        $criteria->compare('t.category',$this->category);

        // $criteria->compare('id',$this->id);
        // $criteria->compare('content',$this->content,true);
        // $criteria->compare('create_time',$this->create_time);
        // $criteria->compare('status',$this->status);
        // $criteria->compare('author_id',$this->author_id);
        // $criteria->compare('files',$this->files,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 9,
            ),
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchNews()
    {
        $dataProvider = $this->search();

        // Filter out system news.
        $dataProvider->criteria->addCondition('t.category IS NOT NULL');

        return $dataProvider;
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
     * This is invoked before the record is validated.
     */
    public function beforeValidate()
    {
        // Relations with new models handler 'HAS_MANY' and 'MANY_MANY'.
        // Find or create objects and validate.
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

            // TODO: get author form user model.
            $this->author_id = 1;
        }

        // Set defaults.
        if (empty($this->publication_time)) {
            $this->publication_time = new CDbExpression('NOW()');
        }
        if (empty($this->status)) {
            $this->status = self::STATUS_ACTIVE;
        }

        // Relations with new models handler 'HAS_MANY' and 'MANY_MANY'.
        // Save new models.
        foreach ($this->files as $m) $m->save();

        return parent::beforeSave();
    }

    /**
     * Relations with new models handler.
     * Finds, creates and validates models from tabular input.
     */
    public function filesTabular()
    {
        $valid = true;
        $modelArray = array();

        // Upload handler.
        $uploads = CUploadedFile::getInstances($this, 'files');
        foreach ($uploads as $file) {
            $model = new Annfile;

            $model->name = $file;

            $valid = $model->validate() && $valid;
            $modelArray[] = $model;
        }

        $this->files = array_merge($this->files, $modelArray);
        if (!$valid) $this->addError('files', 'Неверно задано поле ' . $this->getAttributeLabel('files'));
    }

    /**
     * Creates new system Announcement model message.
     */
    public static function createSystemAnnouncement($title, $content, $organization_id)
    {
        $model = new Announcement('system');

        $model->title = $title;
        $model->content = $content;
        $model->organization = $organization_id;

        $model->save();
    }

    /**
     * Finds latest Announcement news.
     * @param int $limit the limit of news array.
     * @return array of Announcement models.
     */
    public static function getLatestNews($limit)
    {
        $criteria=new CDbCriteria;

        // Filter system news.
        $criteria->addCondition('category IS NOT NULL');

        $criteria->order = 'id DESC';
        $criteria->limit = $limit;

        return Announcement::model()->findAll($criteria);
    }
}
