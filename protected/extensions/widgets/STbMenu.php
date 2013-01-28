<?php
/**
 * STbMenu class file.
 * @author lsd
 * @package bootstrap.widgets
 * Add new types of menu - PLAIN, BOX
 * Only because not has its in bootstrap
 *
 * Add new property HEADER
 */

Yii::import('bootstrap.widgets.TbBaseMenu');

/**
 * Bootstrap menu.
 * @see http://twitter.github.com/bootstrap/components.html#navs
 */
class STbMenu extends TbMenu
{
	// Menu new menu types.
	const TYPE_PLAIN = 'tabs-plain';
	const TYPE_BOX = 'tabs-box';

	/**
	 * Header text what show before Tabs
	 */
	public $header = false;

	
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();

		//$classes = array('nav');

		$validTypes = array(self::TYPE_TABS, self::TYPE_PILLS, self::TYPE_LIST, self::TYPE_PLAIN, self::TYPE_BOX);

		if (isset($this->type) && in_array($this->type, $validTypes))
			$classes[] = 'nav-'.$this->type;

		if ($this->stacked && $this->type !== self::TYPE_LIST)
			$classes[] = 'nav-stacked';

		if ($this->dropup === true)
			$classes[] = 'dropup';

		if (isset($this->scrollspy))
		{
			$scrollspy = is_string($this->scrollspy) ? array('target'=>$this->scrollspy) : $this->scrollspy;
			$this->widget('bootstrap.widgets.TbScrollSpy', $scrollspy);
		}

		if (!empty($classes))
		{
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class']))
				$this->htmlOptions['class'] .= ' '.$classes;
			else
				$this->htmlOptions['class'] = $classes;
		}
	}

		/**
	 * Renders the menu items.
	 * @param array $items menu items. Each menu item will be an array with at least two elements: 'label' and 'active'.
	 * It may have three other optional elements: 'items', 'linkOptions' and 'itemOptions'.
	 */
	protected function renderMenu($items)
	{
		if ($this->header) {
			echo CHtml::openTag('div', array('class'=>'nav-'.$this->type.'-header'));
			echo CHtml::encode($this->header);
			echo '</div>';
		}
		
		parent::renderMenu($items);

	}

}
