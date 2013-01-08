<?php
/**
 * STbBox widget class
 */
Yii::import('bootstrap.widgets.TbBox');

class STbBox extends TbBox
{
	
		/**
	 * Widget initialization
	 */
	public function init()
	{
		if (isset($this->htmlOptions['class']))
			$this->htmlOptions['class'] = 'bootstrap-widget ' . $this->htmlOptions['class'];
		elseif ($this->content === false) 
			$this->htmlOptions['class'] = $this->htmlOptions['class'];
		else 
			$this->htmlOptions['class'] = 'bootstrap-widget';

		if (isset($this->htmlContentOptions['class']))
			$this->htmlContentOptions['class'] = 'bootstrap-widget-content ' . $this->htmlContentOptions['class'];
		else
			$this->htmlContentOptions['class'] = 'bootstrap-widget-content';

		if (!isset($this->htmlContentOptions['id']))
			$this->htmlContentOptions['id'] = $this->getId();

		if (isset($this->htmlHeaderOptions['class']))
			$this->htmlHeaderOptions['class'] = 'bootstrap-widget-header ' . $this->htmlHeaderOptions['class'];
		else
			$this->htmlHeaderOptions['class'] = 'bootstrap-widget-header';

		echo CHtml::openTag('div', $this->htmlOptions);

		$this->registerClientScript();
		$this->renderHeader();
		$this->renderContentBegin();
	}

	
	/*
	  * Renders the opening of the content element and the optional content
	  */
	public function renderContentBegin()
	{
		if ($this->content != false) 
			echo CHtml::openTag('div', $this->htmlContentOptions);
		if (!empty($this->content)) {
			echo $this->content;
		}
	}

	/*
	 * Closes the content element
	 */
	public function renderContentEnd()
	{
		if ($this->content !== false)
			echo CHtml::closeTag('div');
	}

}