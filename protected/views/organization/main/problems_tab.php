<!-- PROBLEMS end -->
<?php $this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider' => new CArrayDataProvider(
			Problem::model()->findAll(),
			array('pagination'=>false)
		),
		'itemView' => 'main/problem',
		'viewData' => array('groupMarker' => 0),
		'template' => '{items}{pager}', // Hide summary header.
		'itemsCssClass' => 'org-main-problem-items', // Items container class. Default: items.
		'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
	)); ?>
<!-- PROBLEMS end -->
