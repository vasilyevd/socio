<?php

/**
 * This is the model class for table "{{image}}".
 *
 * The followings are the available columns in table '{{image}}':
 * @property integer $id
 * @property string $file
 * @property string $create_time
 * @property integer $organization_id
 *
 * The followings are the available model relations:
 * @property AlbumImage[] $albumImages
 * @property Organization $organization
 */
class Image extends CActiveRecord
{
    public $defaultAlbum;
    public $defaultComment;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Image the static model class
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
        return 'org_image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('defaultAlbum, defaultComment', 'required'),
            array('defaultAlbum', 'numerical', 'integerOnly'=>true),
            // Upload handler.
            array(
                'file',
                'file',
                'allowEmpty' => false,
                // 'maxFiles' => 10,
                'maxSize' => 2*(1024*1024), //2MB
                'minSize' => 1024, //1KB
                'types' => 'jpeg, jpg, gif, png',
                // 'mimeTypes' => 'image/jpeg, image/gif, image/png',
            ),

            array('id, file, create_time, organization_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'albums' => array(self::MANY_MANY, 'Album', 'org_album_image(image_id, album_id)'),
        );
    }

    /**
     * @return array behaviors for current model.
     */
    public function behaviors()
    {
        return array(
            // Upload handler.
            'UploadBehavior' => array(
                'class' => 'application.components.behaviors.UploadBehavior',
                'attributes' => array('file'),
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
            'file' => 'Файл',
            'create_time' => 'Время Создания',
            'organization_id' => 'Организация',
            'defaultAlbum' => 'Альбом',
            'defaultComment' => 'Комментарий',
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
        $criteria->compare('file',$this->file,true);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('organization_id',$this->organization_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * This is invoked before the record is saved.
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
     * This is invoked after the record is saved.
     */
    public function afterSave()
    {
        parent::afterSave();

        // Create default link for this image
        if (!empty($this->defaultAlbum) && !empty($this->defaultComment)) {
            $link = new AlbumImage;
            $link->image_id = $this->id;
            $link->album_id = $this->defaultAlbum;
            $link->comment = $this->defaultComment;
            $link->save();
        }
    }

    /**
     * Retrieves comment for current image and selected album.
     * @param int Album model id.
     * @return string comment.
     */
    public function getAlbumComment($albumId)
    {
        $albumLink = AlbumImage::model()->find(
            'image_id=:image_id AND album_id=:album_id',
            array(
                ':image_id' => $this->id,
                ':album_id' => $albumId,
            ));

        if (!empty($albumLink)) {
            return $albumLink->comment;
        }
    }
}
