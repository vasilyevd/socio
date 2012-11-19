<?php

/**
 * This is the model class for table "{{album_image}}".
 *
 * The followings are the available columns in table '{{album_image}}':
 * @property integer $id
 * @property integer $album_id
 * @property integer $image_id
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Album $album
 * @property Image $image
 */
class AlbumImage extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AlbumImage the static model class
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
        return 'org_album_image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('album_id, image_id, comment', 'required'),
            array('album_id, image_id', 'numerical', 'integerOnly'=>true),

            array('id, album_id, image_id, comment', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
            'image' => array(self::BELONGS_TO, 'Image', 'image_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'album_id' => 'Альбом',
            'image_id' => 'Изображение',
            'comment' => 'Комментарий',
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
        $criteria->compare('album_id',$this->album_id);
        $criteria->compare('image_id',$this->image_id);
        $criteria->compare('comment',$this->comment,true);

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
        // Find and delete duplicate image links in target album.
        $links = AlbumImage::model()->findAll(
            'album_id=:album_id AND image_id=:image_id',
            array(
                ':album_id' => $this->album_id,
                ':image_id' => $this->image_id,
            ));
        foreach ($links as $l) {
            $l->delete();
        }

        return parent::beforeSave();
    }
}
