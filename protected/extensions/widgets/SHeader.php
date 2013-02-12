<?php
/**
 * SHeader widget class
 */
Yii::import('bootstrap.widgets.TbBox');

class SHeader extends CWidget
{

	public $htmlOptions=array();

	/** @var string header text */
	public $text = "";

	/** @var string text of sub-header */
	public $subtext;

	/** @var string text of sub-header info block */
	public $subinfo;

	/** @var string header-menu content */
	public $menu=false;

	/** @var string tag for header text */
	public $tag="h4";
	public $htmlOptionsContainer = array();

	private $subheader = false;


		/**
	 * Widget initialization
	 */
	public function init()
	{
		$classes = array('page-header');
		if (isset($this->htmlOptionsContainer['class']))
			$classes[] = $this->htmlOptionsContainer['class'];
		$classes = implode(' ', $classes);
		$this->htmlOptionsContainer['class'] = $classes;

		if (!isset($this->htmlOptionsContainer['id']))
			$this->htmlOptionsContainer['id'] = $this->getId();

		if(isset($this->subtext)) $this->subheader = true;
		if(isset($this->subinfo)) $this->subheader = true;

	}

	public function run()
	{
		echo CHtml::openTag('div', $this->htmlOptionsContainer);
			$this->renderMenu();
			echo CHtml::openTag($this->tag, $this->htmlOptions);
				echo $this->text;
			echo CHtml::closeTag($this->tag);
		echo CHtml::closeTag('div');

		$this->renderSub();
	}

	public function renderMenu(){
		if($this->menu!==false){
			echo CHtml::openTag('div', array('class'=>'header-menu'));
				echo $this->menu;
			echo CHtml::closeTag('div');
		}
	}

	public function renderSub(){
		if($this->subheader===true ){
			echo CHtml::openTag('div', array('class'=>'sub-header'));
			if(isset($this->subtext))
				echo $this->subtext;
			if(isset($this->subinfo)) {
				echo CHtml::openTag('div', array('class'=>'info'));
				echo $this->subinfo;
				echo CHtml::closeTag('div');
			}
			echo CHtml::closeTag('div');
		}
	}


}
