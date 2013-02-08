<?php
/**
 * This is the model class for table "geo_city_ua".
 *
 * @property integer $limit
 * @property string $order_by
 * @property integer $region_id
 * @property integer $id
 * @property integer $district
 * @property string $name
 * @property string $ru_name
 * @property integer $type
 * @property integer $kod
 * @property integer $parentid
 * @property integer $kript
 *
 * Geters and Setters
 * @property string $DefaultOrderWay Направление сортировки по умолчанию
 * @property string $DefaultOrder - Строка для ORDER BY
 * @property string $preName - Type + NAME
 * @property string $avatarURL
 * @property array $TypeNames
 *
 * relations
 * @property CityProfile $profile
 * @property Foto[] $pictures
 */
class CityUa extends CActiveRecord
{
	public $limit;
	public $order_by;
	public $letter;


	/**
	 * @return array
	 */
	public function getTypeNames () {
		return array(
			'0' => 'не известно',
			'1' => 'місто',
			'2' => 'смт', // пгт
			'3' => 'селище', // поселок
			'4' => 'село', // село
		);		
	}

	public static function model($className=__CLASS__)
	{
		//return parent::model($className);
		return parent::model($className)->cache(3600, NULL, 1);

	}

	public function tableName()
	{
		return 'geo_city';
	}

	public function rules()
	{
		return array(
			array('region_id, district, type, parentid, kript', 'numerical', 'integerOnly'=>true),
			array('name, ru_name, kod', 'length', 'max'=>255),
			array('id, region_id, district, name, type, kod, parentid, kript, region2, letter, order_by', 'safe', 'on'=>'search'),
		);
	}


	/**
	 * @return CityProfile $profile
	 */
	public function relations()
	{
		return array(
			'region2'=>array(self::BELONGS_TO, 'GeoRegionsUa', 'region_id'),
			'district2'=>array(self::BELONGS_TO, 'GeoDistrictsua', 'district'),
			'parentcity'=>array(self::BELONGS_TO, 'CityUa', 'parentid'),
			
			
			'adreses'=>array(self::HAS_MANY, 'Address', 'city_id', 'select'=>false,),
			'roless'=>array(self::HAS_MANY, 'ObjAdrRole', array('id'=>'addr_id'), 'through'=>'adreses'),
			'ojects'=>array(self::HAS_MANY, 'Object', array('obj_id'=>'id'),'through'=>'roless', ),

			'objects'=>array(self::HAS_MANY, 'Object', 'city'),
			'objectCount'=>array(self::STAT, 'Object', 'city', 'condition'=>"active='".Object::ACTIVE_YES."'",),
			
			'profile'=>array(self::HAS_ONE, 'CityProfile', 'city_id'),
			'pictures'=>array(self::MANY_MANY, 'Foto', 'geo_city_foto(city_id, foto_id)'),

		);
	}
	
	// scope - города обл значения
	/**
	 * @return CityUa
	 */
	public function mainincountry()
{
    $this->getDbCriteria()->mergeWith(array(
        'condition' => "kript= 0",
    ));
    return $this;
}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'region_id' => 'ID области',
			'region2' => 'Область',
			'district' => 'Район',
			'name' => 'название',
			'ru_name'=>'русское название',
			'type' => 'Тип',
			'kod' => 'код КОАТУУ',
			'parentid' => 'Parentid',
			'kript' => 'Kript',
		);
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		
		// $criteria->with=array('region2');
		$criteria->compare('id',$this->id);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('district',$this->district);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.ru_name',$this->name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('kod',$this->kod,true);
		$criteria->compare('parentid',$this->parentid);
		$criteria->compare('kript',$this->kript);
		
		if(isset($this->letter)) $criteria->addSearchCondition('name', $this->letter.'%', false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>$this->limit ? $this->limit : 10,	
					'pageVar'=>'p',					
			),
			'sort'=>array(
					'defaultOrder'=>$this->DefaultOrder,
			)

			)
		);
		
	}

	function getDefaultOrderWay()
	{
		switch ($this->order_by) {
			case 'type':
				return 'ASC';
				break;
			case 'name':
				return 'ASC';
				break;
			case 'district':
				return 'ASC';
				break;
			default:
				return 'ASC';
		}
	}

	/**
	 * @return string
	 */
	function getDefaultOrder (){
		if($this->order_by) {
			return $this->order_by.' '.$this->DefaultOrderWay;
		}
		else {
			$this->order_by = 'type';
			if(!$this->region_id) {
				return 't.type'.' '.$this->DefaultOrderWay;
			}
			else{
				return 't.type, t.name';
			}
		}

	}

	/**
	 * @return string Имя города с приставкой (type NAME)
	 */
	function getPrename()	{
	return Yii::t('city',$this->type)." ".$this->name;
	}

	/**
	 * @return string
	 */
	function getLi()
	{
		$result = Yii::t('city',$this->type)." ".$this->name;
				
		if($this->parentid!=0) $span = "м. ".$this->parentcity->name.",<br>";
		
		if($this->district!=0) {
				$span .= $this->district2->name." район";
				if($this->region_id!=0) $span .= ",<br>";
			} else {
				if ($this->parentcity->district!=0) {
					$span .= $this->parentcity->district2->name." район";
					if($this->region_id!=0) $span .= ",<br>";
				}
			}
		if($this->region_id!=0) $span .= $this->region2->name ;
		
		if ($span) $result.= "<br><span>".$span."</span>";
	return $result;
	}

	/**
	 * @return array
	 */
	public function getLettersAll ()
	{
		/*
		SELECT DISTINCT SUBSTRING( name, 1, 1 ) letter
			FROM geo_city_ua
			ORDER BY letter
	*/

	/*
		$cr = new CDbCriteria();
		$cr->select = "SUBSTRING(name,1,1) as letter";
		$cr->distinct = true; 
		$letters = $this->findAll($cr);
	 //$result=$this->findAll(Array('select'=>'count(*) as counts, ADR_CITY','condition'=>'ADR_CITY!="" and PREMODERATED=1','group'=>'trim(ADR_CITY)','order'=>'counts desc','limit'=>10));
*/
	 $letters = Yii::app()->db->cache(3600)->createCommand()
    ->selectDistinct('SUBSTRING( name, 1, 1 ) as letter')
    ->from($this->tableName())
		->order('letter')
    ->queryAll();
	
			return $letters;
	}

	/**
	 * @return array
	 */
	public function getGeoArray()
	{
		$cache_time = 86400;
		$arr = array();
			$arr['region']=array('s'=>$this->cache($cache_time)->region2->name, 'id'=>$this->region_id, 'type'=>'region');
			if($this->parentid!=0) $arr['parentcity']=array('s'=>"м. ".$this->cache($cache_time)->parentcity->name, 'id'=>$this->parentid, 'type'=>'city');
			if($this->district!=0) {
					$arr['district']=array('s'=>$this->cache($cache_time)->district2->fullname, 'id'=>$city->district, 'type'=>'district');
			} else {		
					if ($this->cache($cache_time)->parentcity->district!=0) {
						$arr['district']=array('s'=>$this->cache($cache_time)->parentcity->cache($cache_time)->district2->fullname, 'id'=>$this->parentcity->cache($cache_time)->district2->district_id, 'type'=>'district');
					}
			}
		return $arr;
	}

	public function isDistrictCenter()
	{

	}

}