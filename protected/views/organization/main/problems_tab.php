<!-- PROBLEMS end -->
<?php
$dataProvider = new CArrayDataProvider(
	Problem::model()->findAll(),
	array('pagination'=>false)
);

$this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider' => $dataProvider,
		'itemView' => 'main/problem',
		'viewData' => array('groupMarker' => 0, 'count'=>$dataProvider->getItemCount()),
		'template' => '{items}', // Hide summary header.
		'itemsCssClass' => 'org-main-problems', // Items container class. Default: items.
		'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
	)); ?>
<!-- PROBLEMS end -->
