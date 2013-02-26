<?php

/**
 * This is the model class for table "org_catorganization".
 *
 * The followings are the available columns in table 'org_catorganization':
 * @property integer $id
 * @property string $name
 * @property string $registration_date
 * @property string $address
 * @property integer $address_id
 * @property integer $city_id
 * @property integer $region_id
 * @property string $chief_fio
 * @property string $registration_num
 * @property string $phone
 * @property string $website
 * @property string $email
 * @property integer $organization_id
 * @property integer $is_legal
 * @property integer $action_area
 * @property string $directions_more
 * @property string $logo
 * @property integer $is_branch
 * @property string $branch_master
 * @property integer $is_verified
 *
 * The followings are the available model relations:
 * @property CatorganizationDirection[] $catorganizationDirections
 */
class BaseCatorganization extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Catorganization the static model class
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
      //return 'org_catorganization';
	    // return table name with DB name to get relations from different DBs to work
	    $name = preg_match("/dbname=([^;]*)/", $this->dbConnection->connectionString, $matches);
	    return $matches[1].'.org_catorganization';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
		        array(
			        'organization, directions',
			        'application.components.validators.ExistRelationValidator',
		        ),
            array('name', 'required', 'on'=>'insert, update'),
	          array('address', 'safe', 'on'=>'cultivate'),
	          array('name', 'safe', 'on'=>'cultivate'),
            array('address_id, city_id, region_id, action_area', 'numerical', 'integerOnly'=>true),
            array('chief_fio, registration_num, phone, website, email, directions_more, branch_master', 'length', 'max'=>255),
            array('registration_date', 'date', 'format' => 'yyyy-MM-dd', 'allowEmpty'=>true),
            array('action_area', 'in', 'range' => array(
                Organization::ACTION_AREA_NATION, Organization::ACTION_AREA_REGION,
                Organization::ACTION_AREA_DISTRICT, Organization::ACTION_AREA_CITY,
                Organization::ACTION_AREA_COUNTRY,
            )),
            //array('email', 'email'),
            array('website', 'url'),
            array('is_legal, is_branch, is_verified', 'boolean'),
            // Upload handler.
            array(
                'logo',
                'file',
                'allowEmpty' => true,
                // 'maxFiles' => 10,
                'maxSize' => 2*(1024*1024), //2MB
                'minSize' => 1024, //1KB
                'types' => 'jpeg, jpg, gif, png',
                // 'mimeTypes' => 'image/jpeg, image/gif, image/png',
            ),
	          array('word_name', 'safe', 'on' => 'search' ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'directions' => array(self::MANY_MANY, 'Direction', 'org_catorganization_direction(catorganization_id, direction_id)'),
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
                'attributes' => array('logo'),
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
            'registration_date' => 'Дата Регистрации',
            'address' => 'Адрес',
            'address_id' => 'Адрес',
            'city_id' => 'Город',
            'region_id' => 'Область',
            'chief_fio' => 'Руководство',
            'registration_num' => 'Регистрационный Номер',
            'phone' => 'Телефоны',
            'website' => 'Сайт организации',
            'email' => 'Емейл организации',
            'organization_id' => 'Организация',
            'is_legal' => 'Легальная',
            'action_area' => 'Масштаб Деятельности',
            'directions_more' => 'Доп. направления',
            'logo' => 'Логотип',
            'is_branch' => 'Осередок',
            'branch_master' => 'Название Главной Организации',
            'is_verified' => 'Проверенно',
            'organization' => 'Связанная Организация',
            'directions' => 'Направления деятельности',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($opt=array())
    {
        $criteria = new CDbCriteria;

        $criteria->with = array(
            'directions' => array('select' => false),
        );

        if (!empty($this->directions)) {
            $criteria->with['directions']['together'] = true;
            $criteria->addInCondition('directions.id', $this->directions);
        }

        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.action_area', $this->action_area);
        $criteria->compare('t.city_id', $this->city_id);

        // Admin cgridview search options.
        $criteria->compare('t.registration_date', $this->registration_date, true);
        $criteria->compare('t.is_legal', $this->is_legal);
        $criteria->compare('t.is_branch', $this->is_branch);
        $criteria->compare('t.is_verified', $this->is_verified);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
	          'pagination'=>(isset($opt['pagination'])) ? $opt['pagination'] : array(),
	      ));
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave()
    {
        if ($this->isNewRecord) {
            // Upload handler. Set default placeholder image.
            $this->logo = $this->logo === null ? 'placeholder.jpg' : $this->logo;
        }

        // Empty master name if is not branch.
        if ($this->is_branch == false) {
            $this->branch_master = null;
        }

        return parent::beforeSave();
    }
}
