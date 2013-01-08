<li>
	<?php
	$this->widget('ext.widgets.STbBox', array(
			'title' => 'Типы - '.Lookup::item('OrgtypeGroup', 1),
			'headerIcon' => 'icon-home',
			'content' => false,
		));
	?>
	<?php $this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider' => new CArrayDataProvider(
			Orgtype::model()->findAll(array('condition'=>'t.group=1')),
			array('pagination'=>false)
		),
		'itemView' => 'main/type',
		'viewData' => array('groupMarker' => 0),
		'template' => '{items}', // Hide summary header.
		'itemsCssClass' => 'org-main-type-items', // Items container class. Default: items.
		'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
	)); ?>
</li>

<li>
	<?php
	$this->widget('ext.widgets.STbBox', array(
			'title' => 'Типы - '.Lookup::item('OrgtypeGroup', 2),
			'headerIcon' => 'icon-home',
			'content' => false,
		));
	?>
	<?php $this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider' => new CArrayDataProvider(
			Orgtype::model()->findAll(array('condition'=>'t.group=2')),
			array('pagination'=>false)
		),
		'itemView' => 'main/type',
		'viewData' => array('groupMarker' => 0),
		'template' => '{items}', // Hide summary header.
		'itemsCssClass' => 'org-main-type-items', // Items container class. Default: items.
		'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
	)); ?>
</li>