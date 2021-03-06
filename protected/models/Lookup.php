<?php

/**
 * This is the model class for table "{{lookup}}".
 *
 * The followings are the available columns in table '{{lookup}}':
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends CActiveRecord
{
    private static $_items = array();

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Lookup the static model class
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
        return 'org_lookup';
    }

    /**
     * Returns the items for the specified type.
     * @param string item type (e.g. 'PostStatus').
     * @return array item names indexed by item code. The items are order by their position values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type)
    {
        if(!isset(self::$_items[$type]))
            self::loadItems($type);
        return self::$_items[$type];
    }

    public static function itemsByCodes($type,$codes=array())
    {
        if(!isset(self::$_items[$type]))
            self::loadItems($type);

        $result = array();
        foreach ($codes as $c) {
            $result[] = self::item($type, $c);
        }
        return $result;
    }

    public static function itemsListReplace($type,$list,$attr)
    {
        if(!isset(self::$_items[$type]))
            self::loadItems($type);

        foreach ($list as $i=>$l) {
            $list[$i][$attr] = self::item($type, $l[$attr]);
        }
        return $list;
    }

    /**
     * Returns the item name for the specified type and code.
     * @param string the item type (e.g. 'PostStatus').
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type,$code)
    {
        if(!isset(self::$_items[$type]))
            self::loadItems($type);
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type)
    {
        self::$_items[$type]=array();
        $models=self::model()->findAll(array(
            'condition'=>'type=:type',
            'params'=>array(':type'=>$type),
            'order'=>'position',
        ));
        foreach($models as $model)
            self::$_items[$type][$model->code]=$model->name;
    }
}
