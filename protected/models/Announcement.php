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
 * @property string $files
 * @property integer $category
 */
class Announcement extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const CATEGORY_GENERAL = 1;
    const CATEGORY_GRANT = 2;
    const CATEGORY_ANOTHER = 3;

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
            array('title, content, publication_time, status, category', 'required'),
            array('status, category', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>128),
            // Upload handler.
            array(
                'files',
                'file',
                'allowEmpty' => true,
                'maxFiles' => 10,
                'maxSize' => 2*(1024*1024), //2MB
                'minSize' => 1024, //1KB
                // 'types' => 'jpeg, jpg, gif, png',
                // 'mimeTypes' => 'image/jpeg, image/gif, image/png',
            ),
            array('publication_time', 'date', 'format'=>'yyyy-MM-dd HH:mm:ss'),
            array('category', 'in', 'range' => array(
                self::CATEGORY_GENERAL, self::CATEGORY_GRANT,
                self::CATEGORY_ANOTHER,
            )),
            array('status', 'in', 'range' => array(
                self::STATUS_ACTIVE, self::STATUS_INACTIVE,
            )),
            array('content','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),

            array('id, title, content, create_time, publication_time, status, organization_id, author_id, files, category', 'safe', 'on'=>'search'),
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
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
        );
    }

    /**
     * @return array behaviors for current model.
     */
    public function behaviors()
    {
        return array(
            // Upload handler.
            'MultiUploadBehavior' => array(
                'class' => 'application.components.behaviors.MultiUploadBehavior',
                'attributes' => array('files'),
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
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('create_time',$this->create_time);
        $criteria->compare('publication_time',$this->publication_time);
        $criteria->compare('status',$this->status);
        $criteria->compare('organization_id',$this->organization_id);
        $criteria->compare('author_id',$this->author_id);
        $criteria->compare('files',$this->files,true);
        $criteria->compare('category',$this->category);

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

            // TODO: get author form user model.
            $this->author_id = 1;
        }

        return parent::beforeSave();
    }
}
