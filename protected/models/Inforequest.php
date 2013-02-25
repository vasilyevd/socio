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
    public $isSenderUserSelf;

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
            // General scenario.
            array(
                'receiverGovorganization',
                'application.components.validators.ExistRelationValidator',
            ),
            array('name, type, send_date, sender_type, receiverGovorganization', 'required'),
            array('type, sender_type', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('description', 'safe'),
            array('type', 'in', 'range' => self::model()->Type->rule),
            array('sender_type', 'in', 'range' => self::model()->SenderType->rule),
            array('send_date, receive_date', 'date', 'format' => 'yyyy-MM-dd'),
            array('is_finished', 'boolean'),

            // 'senderUser' scenario.
            array(
                'senderUser',
                'senderUserRelationValidator',
                'safe' => false,
                'on' => 'senderUser',
            ),
            array('sender_text', 'length', 'max' => 128, 'on' => 'senderUser'),
            array('isSenderUserSelf', 'boolean', 'on' => 'senderUser'),

            // 'senderOrganization' scenario.
            array(
                'senderOrganization',
                'application.components.validators.ExistRelationValidator',
                'on' => 'senderOrganization',
            ),
            array('senderOrganization', 'required', 'on' => 'senderOrganization'),

            // 'senderBizorganization' scenario.
            array(
                'senderBizorganization',
                'application.components.validators.ExistRelationValidator',
                'on' => 'senderBizorganization',
            ),
            array('senderBizorganization', 'required', 'on' => 'senderBizorganization'),

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
            'senderUser' => array(self::BELONGS_TO, 'PersonUser', 'sender_id'),
            'senderOrganization' => array(self::BELONGS_TO, 'Organization', 'sender_id'),
            'senderBizorganization' => array(self::BELONGS_TO, 'Govorganization', 'sender_id'),
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
            'isSenderUserSelf' => 'Отправитель Текущий Пользователь',
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
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave()
    {
        if ($this->isNewRecord) {
            // Save current time.
            $this->create_time = new CDbExpression('NOW()');

            // Set the model user as current one.
            $this->user = Yii::app()->user->id;
        }

        // Allow null date database field.
        if (empty($this->receive_date)) {
            $this->receive_date = null;
        }

        // Set 'sender_text' and 'receiver_text' from relations.
        switch ($this->sender_type) {
            case $this->SenderType->find('USER'):
                if ($this->isSenderUserSelf) {
                    $this->sender_text = $this->senderUser->fio;
                }
                break;
            case $this->SenderType->find('ORGANIZATION'):
                $this->sender_text = $this->senderOrganization->name;
                break;
            case $this->SenderType->find('BIZORGANIZATION'):
                $this->sender_text = $this->senderBizorganization->name;
                break;
        }
        $this->receiver_text = $this->receiverGovorganization->name;

        return parent::beforeSave();
    }

    /**
     * Transforms attribute data to relation and validates it.
     * @param string $attribute the attribute being validated.
     * @param array $params the list of validation parameters.
     */
    public function senderUserRelationValidator($attribute, $params)
    {
        $relation = null;
        $valid = true;

        // If 'isSenderUserSelf' set 'senderUser' as current user.
        if ($this->isSenderUserSelf) {
            $relation = Yii::app()->user->data();

            if (is_null($relation)) {
                $valid = false;
            }
        }

        $this->$attribute = $relation;
        if (!$valid) $this->addError($attribute, 'Неверно задано поле ' . $this->getAttributeLabel($attribute));
    }
}
