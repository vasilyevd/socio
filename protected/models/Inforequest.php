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
 * @property integer $is_finished
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Infofile[] $infofiles
 * @property InforequestInfocategory[] $inforequestInfocategories
 */
class Inforequest extends CActiveRecord
{
    public $senderUser;
    public $senderOrganization;
    public $senderBizorganization;

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
            array('name, type, send_date, sender_text, sender_type, receiver_text', 'required'),
            array('type, sender_type, senderUser, senderOrganization, senderBizorganization receiver', 'numerical', 'integerOnly' => true),
            array('name, sender_text, receiver_text', 'length', 'max' => 128),
            array('description', 'safe'),
            array('type', 'in', 'range' => self::model()->Type->rule),
            array('sender_type', 'in', 'range' => self::model()->SenderType->rule),
            array('send_date, receive_date', 'date', 'format' => 'yyyy-MM-dd'),
            array('is_finished', 'boolean'),
            array('senderUser', 'exist', 'attributeName' => 'id', 'className' => 'PersonUser'),
            array('senderOrganization', 'exist', 'attributeName' => 'id', 'className' => 'Organization'),
            array('senderBizorganization', 'exist', 'attributeName' => 'id', 'className' => 'Govorganization'),

            // array('id, name, description, type, create_time, send_date, receive_date, user_id', 'safe', 'on' => 'search'),
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
     * @return array behaviors for current model.
     */
    public function behaviors()
    {
        return array(
            // Advanced relations
            'EActiveRecordRelationBehavior' => array(
                'class' => 'application.components.behaviors.EActiveRecordRelationBehavior'
            ),
            // Constants.
            'Type' => array(
                'class' => 'application.components.behaviors.constants.InforequestTypeBehavior',
                'attribute' => 'type',
            ),
            'SenderType' => array(
                'class' => 'application.components.behaviors.constants.InforequestSenderTypeBehavior',
                'attribute' => 'sender_type',
            ),
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
            'is_finished' => 'Статус Ответа',
            'user' => 'Автор',
            'sender_text' => 'Отправитель',
            'sender_type' => 'Тип Отправителя',
            'senderUser' => 'Отправитель',
            'senderOrganization' => 'Отправитель',
            'senderBizorganization' => 'Отправитель',
            'receiver_text' => 'Получатель',
            'receiver' => 'Получатель Государственная Организация',
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
        $criteria->compare('is_finished', $this->is_finished);
        $criteria->compare('sender_text', $this->sender_text, true);
        $criteria->compare('receiver_text', $this->receiver_text, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * This is invoked before the record is validated.
     */
    public function beforeValidate()
    {
        // Create dynamic relation based on 'sender_type'.
        switch ($this->sender_type) {
            case $this->SenderType->find('USER'):
                $this->metaData->addRelation('sender', array(self::BELONGS_TO, 'PersonUser', 'sender_id'));
                $this->sender = $this->senderUser;
                break;
            case $this->SenderType->find('ORGANIZATION'):
                $this->metaData->addRelation('sender', array(self::BELONGS_TO, 'Organization', 'sender_id'));
                $this->sender = $this->senderOrganization;
                break;
            case $this->SenderType->find('BIZORGANIZATION'):
                $this->metaData->addRelation('sender', array(self::BELONGS_TO, 'Govorganization', 'sender_id'));
                $this->sender = $this->senderBizorganization;
                break;
        }

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

            // Set the model user as current one.
            $this->user = Yii::app()->user->data()->id;
        }

        return parent::beforeSave();
    }
}
