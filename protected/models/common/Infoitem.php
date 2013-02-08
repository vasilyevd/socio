<?php

/**
 * This is the model class for table "x_info_items".
 *
 * The followings are the available columns in table 'x_info_items':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $full_text
 * @property string $owner
 * @property string $file
 * @property integer $create_time
 * @property integer $section
 */
class Infoitem extends CActiveRecord {

	const CATEGORY_MAIN = 1; // КОНТРОЛЬ
	const CATEGORY_GOV = 2; // ВЛАСТЬ
	const CATEGORY_METODICS = 3; // ОБУЧЕНИЕ, МЕТОДИКИ И ПРАКТИКИ
	const CATEGORY_PROGRAMS = 4; // ПРОГРАММЫ
	const CATEGORY_SPORT = 5; // ИНВАСПОРТ
	const CATEGORY_TURIZM = 6; // ИНВАТУРИЗМ
	const CATEGORY_LGOTS = 7; // ЛЬГОТЫ

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Infoitem the static model class
	 */
	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'x_info_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, owner, file', 'length', 'max'=>255),
			array('desc, full_text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, section, title, owner', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'desc' => 'Описание',
			'full_text' => 'Текст',
			'owner' => 'Автор',
			'file' => 'Файл',
			'create_time' => 'Время создания',
		);
	}

	public function getCategoryesArray(){
		return array(
			1=>'Контроль',
			2=>'Власть',
			3=>'Обучение',
			4=>'Программы',
			5=>'Инваспорт',
			6=>'Инватуризм',
			//7=>'Льготы',
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
		$criteria->compare('section',$this->section);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('owner',$this->owner,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 30,
			),
		));
	}
}