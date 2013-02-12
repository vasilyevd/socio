<?php

class Category extends CActiveRecord
{

	public $parentId;
	public $lvl2;
	
	private $_treeArrayCan;
	private $_treeArrayCannot;
	
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'obj_category';
    }

    public function rules()
    {
        return array(
            array('name, alias', 'required'),
            array('level, parentId', 'numerical', 'integerOnly' => true),
            array('root, lft, rgt', 'length', 'max' => 10),
            array('name', 'length', 'max' => 250),
            array('id, root, lft, rgt, level, name', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'objects' => array(self::HAS_MANY, 'Object', 'type'),
						'dostup_blanks'=>array(self::MANY_MANY, 'DostupBlank', 'dostup_blank_objtype(objtype_id, blank_id)'),

        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
						'parentId' => 'Корневая категория',
            'alias' => 'Урл'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->order = $this->tree->hasManyRoots
                ? $this->tree->rootAttribute . ', ' . $this->tree->leftAttribute
                : $this->tree->leftAttribute;
        $criteria->compare('id', $this->id, true);
        $criteria->compare('root', $this->root, true);
        $criteria->compare('lft', $this->lft, true);
        $criteria->compare('rgt', $this->rgt, true);
        $criteria->compare('level', $this->level);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('alias', $this->alias, true);
				// echo "CActiveDataProviderCActiveDataProviderCActiveDataProvider";
        return new CActiveDataProvider(get_class($this), array(
                                                              'criteria' => $criteria,
                                                              'pagination' => array(
                                                                  'pageSize' => 500,
                                                              ),
                                                              'sort' => array(
                                                                  'defaultOrder' => 'root ASC, lft ASC',
                                                              ),
                                                         ));
    }
		
		public function behaviors(){
        return array(
        'tree'=>array(
            'class'=>'application.components.behaviors.trees.NestedSetBehavior',
						'hasManyRoots'=>true,
            'leftAttribute'=>'lft',
            'rightAttribute'=>'rgt',
            'levelAttribute'=>'level',
						)
    );
    }

    /**
     * Build tree-like array for display in DropDownList
     * using in admin panel
     * @static
     * @param bool $canSelectNonLeaf can user select category that have children
     * @return string[]
     */
    public static function TreeArray($canSelectNonLeaf = true)
    {
        if ($canSelectNonLeaf) 
					return self::TreeArrayLeafCanSelected();
        else 
					return self::TreeArrayLeafCannotSelected();
    }
		
/**
     * Build tree-like array for display in DropDownList
     * Categories that have children cannot be selected
     * using in admin panel
     * @static
     * @return string[]
     */
    public static function TreeArrayLeafCannotSelected()
    {
        $roots = Category::model()->cache(0)->roots()->cache(0)->findAll();
        $res = array();
        foreach ($roots as $root) {
            if ($root->isLeaf())
                $res[$root->id] = $root->name;
            else
                $res[$root->name] = Category::GetChildrenForTreeArrayLeafCannotSelected($root);
        }

        return $res;
    }
		
			/**
     * Build tree-like array for the category
     * Categories that have children cannot be selected
     * @static
     * @param Category $elem the category for which builds array
     * @return string[]
     */
    private static function GetChildrenForTreeArrayLeafCannotSelected($elem)
    {
        $res = array();
        $roots = $elem->cache(0)->children()->findAll();
        foreach ($roots as $root) {
            if ($root->isLeaf())
                $res[$root->id] = $root->name;
            else
                $res[$root->name] = Category::GetChildrenForTreeArrayLeafCannotSelected($root);
        }
        return $res;
    }

		
		    /**
     * Build tree-like array for display in DropDownList
     * Categories that have children can be selected
     * using in admin panel
     * @static
     * @return string[]
     */
    public static function TreeArrayLeafCanSelected()
    {
        $roots = Category::model()->cache(0)->roots()->cache(0)->findAll();
        $res = array();
        foreach ($roots as $root) {
            $res[$root->id] = $root->GetStringName();
            if (!$root->isLeaf())
                $res = $res + Category::GetChildrenForTreeArrayLeafCanSelected($root, 1);
        }

        return $res;
    }
		
    /**
     * Build tree-like array for the category
     * Categories that have children can be selected
     * @static
     * @param Category $elem the category for which builds array
     * @param integer $i nesting level
     * @return string[]
     */
    private static function GetChildrenForTreeArrayLeafCanSelected($elem, $i)
    {
        $res = array();
        $roots = $elem->cache(0)->children()->findAll();
        foreach ($roots as $root) {
            $res[$root->id] = $root->GetStringName();
            if (!$root->isLeaf())
                $res = $res + Category::GetChildrenForTreeArrayLeafCanSelected($root, $i + 1);
        }
        return $res;
    }
		
		    /**
     * Return category name for dropDownList with spaces before it for tree-like visual view
     * @return string category name with spaces
     */
    public function GetStringName()
    {
        if ($this->isLeaf())
            return str_repeat('&nbsp', ($this->level - 1) * 4) . $this->name;
        else
            return str_repeat('&nbsp', ($this->level - 1) * 4) . "<b>" . $this->name . "</b>";
    }

		public function getRootName()
    {
			if(!$this->isRoot()) {
				return Category::model()->findByPk($this->root)->name;
			} else {
				return $this->name;
			}   
    }
		
		public function getParentName()
    {
			// echo "treb parentname".$this->id;
			if(!$this->isRoot()) {
				$parent = $this->parent()->find();
				// echo "-pid-".$parent->id;
				return $parent->name;
			} else {
				return $this->name;
			}   
    }

		public function getRoot()
    {
				return Category::model()->findByPk($this->root);
    }
		
		public function getLvl2Id()
    {
				return Category::model()->findByPk($this->root);
    }

		public function hasDostupBlank()
		{			
			return count($this->dostup_blanks)>0;
		}


}