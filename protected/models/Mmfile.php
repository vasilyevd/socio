<?php

/**
 * This is the model class for table "org_mmfile".
 *
 * The followings are the available columns in table 'org_mmfile':
 * @property integer $id
 * @property string $name
 * @property integer $category
 * @property integer $massmedia_id
 *
 * The followings are the available model relations:
 * @property Massmedia $massmedia
 */
class Mmfile extends CActiveRecord
{
    const TYPE_GENERAL = 1;
    const TYPE_IMAGE = 2;
    const TYPE_DOCUMENT = 3;

    const CATEGORY_GENERAL = 1;
    const CATEGORY_PRESS_RELEASE = 2;
    const CATEGORY_PRESENTATION = 3;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Mmfile the static model class
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
        return 'org_mmfile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, category', 'required'),
            array('category', 'numerical', 'integerOnly'=>true),
            array('category', 'in', 'range' => array(
                self::CATEGORY_GENERAL, self::CATEGORY_PRESS_RELEASE,
                self::CATEGORY_PRESENTATION,
            )),
            // Upload handler.
            array(
                'name',
                'file',
                'allowEmpty' => true,
                // 'maxFiles' => 10,
                'maxSize' => 2*(1024*1024), //2MB
                'minSize' => 1024, //1KB
                // 'types' => 'jpeg, jpg, gif, png',
                // 'mimeTypes' => 'image/jpeg, image/gif, image/png',
            ),

            // array('id, name, category, massmedia_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'massmedia' => array(self::BELONGS_TO, 'Massmedia', 'massmedia_id'),
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
            // Upload handler.
            'UploadBehavior' => array(
                'class' => 'application.components.behaviors.UploadBehavior',
                'attributes' => array('name'),
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
            'category' => 'Категория',
            'massmedia_id' => 'Элемент СМИ',
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
        $criteria->compare('category',$this->category);
        $criteria->compare('massmedia_id',$this->massmedia_id);

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
        // Find file type by it's extension.
        $fileExtension = strtolower(pathinfo($this->name, PATHINFO_EXTENSION));
        switch ($fileExtension) {
            case 'docx':
            case 'doc':
                $this->type = self::TYPE_DOCUMENT;
                break;
            case 'jpeg':
            case 'jpg':
            case 'gif':
            case 'png':
                $this->type = self::TYPE_IMAGE;
                break;
            default:
                $this->type = self::TYPE_GENERAL;
        }

        return parent::beforeSave();
    }
}
