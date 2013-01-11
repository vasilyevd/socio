<!-- CATEGORYES -->
<?php $this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider' => new CArrayDataProvider(
			Direction::model()->findAll(),
			array('pagination'=>false)
		),
		'itemView' => 'main/direction',
		'template' => '{items}{pager}', // Hide summary header.
		'itemsCssClass' => 'items', // Items container class. Default: items.
		'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
	)); ?>
<!-- CATEGORYES end -->
