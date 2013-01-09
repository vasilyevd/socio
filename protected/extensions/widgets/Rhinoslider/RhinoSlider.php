<?php
class RhinoSlider extends CWidget
{
	/** @var string view file name with items of content */
	public $contentView = false;

	/** @var string separator what separate items in view file */
	public $contentSeparator = false;

	/** @var array of item in slider */
	public $items=array();

	/** @var bool - merge items from view-file and items-array */
	public $merge = false;

	/** @var array options of widget container */
	public $htmlOptions = array();

	/** @var string set theme from css file rhinoslider-XXX.css 1.05*/
	public $theme = 'socio';

	public $options = array();

	private $_assetsUrl;

	public function init()
	{
		if (!isset($this->htmlOptions['id']))
			$this->htmlOptions['id'] = $this->getId();
		else
			$this->id = $this->htmlOptions['id'];
	}

	/**
	 * Run this widget.
	 */
	public function run()
	{
		$id = $this->id;

		echo CHtml::openTag('div', array('class'=>'bootstrap-widget'))."\n";
		echo CHtml::openTag('ul', $this->htmlOptions)."\n";

		if ($this->contentView!=false){
			$this->takeContentFromView($this->contentView);
		}

		if(count($this->items)){
			$this->takeContentFromItems($this->items);
		}

		echo CHtml::closeTag('div');
		echo CHtml::closeTag('ul');

		$this->registerClientScript($id);

	}

	protected function takeContentFromView($view) {
		$owner=$this->getOwner();
		$viewFile=$owner->getViewFile($view);
		$owner->renderFile($viewFile);
	}

	protected function takeContentFromItems($items) {
		//ob_start();
		foreach ($items as $i => $item)
		{
			if (!is_array($item))
				continue;

			if (isset($item['visible']) && $item['visible'] === false)
				continue;

			if (!isset($item['itemOptions']))
				$item['itemOptions'] = array();

			echo CHtml::openTag('li', $item['itemOptions']);

			if (isset($item['image']))
			{
				if (!isset($item['alt']))
					$item['alt'] = '';

				if (!isset($item['imageOptions']))
					$item['imageOptions'] = array();

				echo CHtml::image($item['image'], $item['alt'], $item['imageOptions']);
			}

			if (!empty($item['content'])) {
					echo $item['content'];
			}
		}
		//$content = ob_get_clean();
		//return $content;
	}

	protected function normalizeItems($items, &$panes) {

		return $items;
	}


	public function registerClientScript($id)	{

		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';

		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();
		$cs->registerScript(__CLASS__.'#'.$id,
			"jQuery('#{$id}').rhinoslider({$options});"
		);

		$cs->registerCssFile($this->getAssetsUrl().'/css/rhinoslider-'.$this->theme.'.css');

		$cs->registerScriptFile($this->getAssetsUrl().'/js/easing.js');

		$cs->registerScriptFile($this->getAssetsUrl().'/js/mousewheel.js');
		$cs->registerScriptFile($this->getAssetsUrl().'/js/rhinoslider-1.05.js');

	}

	public function getAssetsUrl() {
			if (isset($this->_assetsUrl))
				return $this->_assetsUrl;
			else
			{
				$assetsPath = dirname(__FILE__).'/assets/';;
				$assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
				return $this->_assetsUrl = $assetsUrl;
			}
		}





	}
