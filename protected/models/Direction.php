<?php

/**
 * This is the model class for table "org_direction".
 *
 * The followings are the available columns in table 'org_direction':
 * @property integer $id
 * @property string $name
 */
class Direction extends BaseDirection
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Direction the static model class
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
		$name = preg_match("/dbname=([^;]*)/", $this->dbConnection->connectionString, $matches);
		return $matches[1].'.org_direction';
		//return 'org_direction';
	}

}
