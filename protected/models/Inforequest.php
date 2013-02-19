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
            array('name, type, send_date, sender_type', 'required'),
            array('type, sender_type, receiverGovorganization', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('description', 'safe'),
            array('type', 'in', 'range' => self::model()->Type->rule),
            array('sender_type', 'in', 'range' => self::model()->SenderType->rule),
            array('send_date, receive_date', 'date', 'format' => 'yyyy-MM-dd'),
            array('is_finished', 'boolean'),
            array('receiverGovorganization', 'exist', 'attributeName' => 'id', 'className' => 'Govorganization'),
            // Apply validation rules for attributes, based on 'sender_type'.
            // array(
            //     'sender_type',
            //     'application.components.validators.YiiConditionalValidator',
            //     'if' => array(
            //         array('sender_type', 'compare', 'compareValue' => self::model()->SenderType->find('USER')),
            //     ),
            //     'then' => array(
            //         array('sender_text', 'required'),
            //         array('sender_text', 'length', 'max' => 128),
            //     ),
            // ),
            // array(
            //     'sender_type',
            //     'application.components.validators.YiiConditionalValidator',
            //     'if' => array(
            //         array('sender_type', 'compare', 'compareValue' => self::model()->SenderType->find('ORGANIZATION')),
            //     ),
            //     'then' => array(
            //         array('senderOrganization', 'required'),
            //         array('senderOrganization', 'numerical', 'integerOnly' => true),
            //         array('senderOrganization', 'exist', 'attributeName' => 'id', 'className' => 'Organization'),
            //     ),
            // ),
            // array(
            //     'sender_type',
            //     'application.components.validators.YiiConditionalValidator',
            //     'if' => array(
            //         array('sender_type', 'compare', 'compareValue' => self::model()->SenderType->find('BIZORGANIZATION')),
            //     ),
            //     'then' => array(
            //         array('senderBizorganization', 'required'),
            //         array('senderBizorganization', 'numerical', 'integerOnly' => true),
            //         array('senderBizorganization', 'exist', 'attributeName' => 'id', 'className' => 'Govorganization'),
            //     ),
            // ),
            //
            //
            //
           //  array('sender_type', 'application.components.validators.FSwitchValidator',
           //  'cases'=>array(
           //     'image'=>array(
           //          array('file',  'required'),
           //          array('file',  'file', 'types'=>'jpg,png'),
           //     ),
           //     3=>array(
           //          array('senderBizorganization', 'required'),
           //          array('senderBizorganization', 'numerical', 'integerOnly' => true),
           //          array('senderBizorganization', 'exist', 'attributeName' => 'id', 'className' => 'Govorganization'),
           //     )
           //  ),
           //  'default'=>array('url', 'url', 'defaultSchema'=>'http') //simple array if only one validator
           // ),

            // array('id, name, description, type, create_time, send_date, receive_date, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'PersonUser', 'user_id'),
            'senderBizorganization' => array(self::BELONGS_TO, 'Govorganization', 'sender_id'),
            'senderUser' => array(self::BELONGS_TO, 'PersonUser', 'sender_id'),
            'senderOrganization' => array(self::BELONGS_TO, 'Organization', 'sender_id'),
            'receiverGovorganization' => array(self::BELONGS_TO, 'Govorganization', 'receiver_id'),
            'responseFile' => array(self::HAS_ONE, 'Infofile', 'inforequest_id'),
            'requestFiles' => array(self::HAS_MANY, 'Infofile', 'inforequest_id'),
            'categories' => array(self::MANY_MANY, 'Infocategory', 'org_inforequest_infocategory(inforequest_id, infocategory_id)'),
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
            'senderUser' => 'Отправитель Пользователь',
            'senderOrganization' => 'Отправитель Общественная Организация',
            'senderBizorganization' => 'Отправитель Коммерческая Организация',
            'receiver_text' => 'Получатель',
            'receiverGovorganization' => 'Получатель Государственная Организация',
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
     * This is invoked when record is populated with the data from database.
     */
    protected function afterFind()
    {
        parent::afterFind();

        // $this->_oldTags=$this->tags;
    }

    /**
     * This is invoked before the record is validated.
     */
    public function beforeValidate()
    {
        // switch ($this->sender_type) {
        //     case $this->SenderType->find('USER'):
        //         $this->metaData->addRelation('sender', array(self::BELONGS_TO, 'PersonUser', 'sender_id'));
        //         $this->sender = $this->senderUser;
        //         break;
        //     case $this->SenderType->find('ORGANIZATION'):
        //         $this->metaData->addRelation('sender', array(self::BELONGS_TO, 'Organization', 'sender_id'));
        //         $this->sender = $this->senderOrganization;
        //         break;
        //     case $this->SenderType->find('BIZORGANIZATION'):
        //         $this->senderUser = null;
        //         $this->senderOrganization = null;
        //         break;
        // }

        $this->sender_text = 'test sender text';
        $this->receiver_text = 'test receiver text';

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

        // Allow null date database field.
        if (empty($this->receive_date)) {
            $this->receive_date = null;
        }

        return parent::beforeSave();
    }
}
