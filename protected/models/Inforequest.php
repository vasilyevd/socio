<?php

/**
 * This is the model class for table "org_inforequest".
 *
 * The followings are the available columns in table 'org_inforequest':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $type
 * @property string $create_time
 * @property string $send_date
 * @property string $receive_date
 * @property integer $finished_status
 * @property integer $user_id
 * @property string $sender_text
 * @property integer $sender_id
 * @property integer $sender_type
 * @property string $receiver_text
 * @property integer $receiver_id
 *
 * The followings are the available model relations:
 * @property Infofile[] $infofiles
 * @property InforequestInfocategory[] $inforequestInfocategories
 */
class Inforequest extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Inforequest the static model class.
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name.
     */
    public function tableName()
    {
        return 'org_inforequest';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type, create_time, send_date, finished_status, user_id, sender_text, sender_type, receiver_text, receiver_id', 'required'),
            array('type, finished_status, user_id, sender_id, sender_type, receiver_id', 'numerical', 'integerOnly' => true),
            array('name, sender_text, receiver_text', 'length', 'max' => 128),
            array('description, receive_date', 'safe'),

            // array('id, name, description, type, create_time, send_date, receive_date, finished_status, user_id, sender, sender_id, sender_type, receiver, receiver_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'requestFiles' => array(self::HAS_MANY, 'Infofile', 'inforequest_id'),
            'responseFile' => array(self::HAS_ONE, 'Infofile', 'inforequest_id'),
            'categories' => array(self::MANY_MANY, 'Infocategory', 'org_inforequest_infocategory(inforequest_id, infocategory_id)'),
            'receiver' => array(self::BELONGS_TO, 'Govorganization', 'receiver_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label).
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'type' => 'Тип',
            'create_time' => 'Время Создания',
            'send_date' => 'Дата Отправки Запроса',
            'receive_date' => 'Дата Получения Ответа',
            'finished_status' => 'Статус Ответа',
            'user_id' => 'Автор',
            'sender_text' => 'Отправитель',
            'sender_id' => 'Отправитель',
            'sender_type' => 'Тип Отправителя',
            'receiver_text' => 'Получатель',
            'receiver_id' => 'Получатель',
        );
    }

    /**
     * Retrieves a list of models based on the current filter conditions.
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria=new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('send_date', $this->send_date, true);
        $criteria->compare('receive_date', $this->receive_date, true);
        $criteria->compare('finished_status', $this->finished_status);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('sender_text', $this->sender_text, true);
        $criteria->compare('sender_id', $this->sender_id);
        $criteria->compare('sender_type', $this->sender_type);
        $criteria->compare('receiver_text', $this->receiver_text, true);
        $criteria->compare('receiver_id', $this->receiver_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
