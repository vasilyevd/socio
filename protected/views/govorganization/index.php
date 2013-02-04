<?php
$this->breadcrumbs=array(
	'Govorganizations',
);

$this->menu=array(
	array('label'=>'Create Govorganization','url'=>array('create')),
	array('label'=>'Manage Govorganization','url'=>array('admin')),
);
?>

<h1>Govorganizations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
