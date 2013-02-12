<?php

class Foto extends CActiveRecord
{
	public $_temp_file_name;
	public $_save_to;
	private $_temp_dir_name = "tempuploads";
	private $_full_path;
	public $_foto_hash;
	public $ext;
	public $_make_avatar_on_save;
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName()	{
		return 'x_fotos';
	}

	public function rules()	{
		return array(
			//array('foto_file', 'required'),
			//array('foto_autor', 'numerical', 'integerOnly'=>true),
			//array('foto_file', 'length', 'max'=>255),
			array('create_time, desc, inva', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, foto_file, foto_autor, create_time, desc, inva', 'safe', 'on'=>'search'),
		);
	}

	public function relations()	{
		return array(
			//'autor'=>array(self::BELONGS_TO, 'Users', 'foto_autor'),
			'objects'=>array(self::MANY_MANY, 'Object', 'obj_foto(obj_id, foto_id)'),
		);
	}

	public function attributeLabels()	{
		return array(
			'id' => 'ID',
			'foto_file' => 'Foto File',
			'foto_autor' => 'Foto Autor',
			'create_time' => 'Create Time',
			'desc' => 'Desc',
			'inva'=>'inva',
		);
	}

	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('foto_file',$this->foto_file,true);
		$criteria->compare('foto_autor',$this->foto_autor);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	private function make_name() {
		return dechex(crc32(md5(uniqid())));
	}
	
	private function move_from_temp() {
		// ��� 
		
		$myfile = Yii::app()->file->set($this->_temp_dir_name.'/'.$this->_temp_file_name, true);
		if ($myfile->exists) {
			$this->ext=$myfile->extension;
			$this->foto_file="o_".$this->_foto_hash.".".$this->ext; 
			
			$destdir = $myfile->createDir(0755,"foto/".$this->_save_to);
			  //echo "--dir created ("."foto/".$this->_save_to.")<br>";
			if ($myfile->copy("foto/".$this->_save_to."/".$this->foto_file )) return true;
		}
		return false;
	}
	
	protected function beforeSave()
	{
		 //echo "bs foto";
    if(parent::beforeSave())
    {
			 //echo "before save foto";
        if($this->isNewRecord && $this->_temp_file_name)
        {
					// ���������� �������� �������� ���������� ����� (� ����������� ������������ �����, �������� ������ �����)
					$this->_foto_hash=$this->make_name();
					if ($this->move_from_temp() && Yii::app()->file->set('foto/'.$this->_save_to."/".$this->foto_file, true)->isFile) {
						 //echo "--moved<br>";
						$image = Yii::app()->image->load('foto/'.$this->_save_to."/".$this->foto_file);
						// 75
						$image->resize(75, 75, Image::AUTO)->quality(70);
						$image->save('foto/'.$this->_save_to."/"."s_".$this->_foto_hash.".".$this->ext);
						// 130
						$image->resize(130, 130, Image::AUTO)->quality(70);
						$image->save('foto/'.$this->_save_to."/"."m_".$this->_foto_hash.".".$this->ext);
						
						// make avatar
						if ($this->_make_avatar_on_save) {
						// 100
							$image->resize(100, 100, Image::AUTO)->quality(80);
							$image->save('foto/'.$this->_save_to."/"."a_".$this->_foto_hash.".".$this->ext);
						// 200
						$image->resize(200, 200, Image::WIDTH)->quality(80);
						$image->save('foto/'.$this->_save_to."/"."b_".$this->_foto_hash.".".$this->ext);
						}
					}
				}
				 //echo "ii=".$this->inva;
				return true;
    }
    else
        return false;
	}	

	public function Src($param=array('xy'=>'s', 'dir'=>''))
    {	
		if (!$param['xy']) $param['xy']='s';  
		if (!$param['dir']) $param['dir']='all';  
		$result = "/foto/".$param['dir']."/".$param['xy']."_".substr($this->foto_file,2);
		return $result;
			
    }
	
	public function getSmall()
	{
		return '/foto/'.str_replace($this->foto_file, 's_'.$this->foto_file, $this->path);
	}

	public function getBig()
	{
		return '/foto/'.str_replace($this->foto_file, 'b_'.$this->foto_file, $this->path);
	}
	
}