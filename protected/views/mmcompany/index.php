<?php
$this->breadcrumbs=array(
	'Mmcompanies',
);

$this->menu=array(
	array('label'=>'Create Mmcompany','url'=>array('create')),
	array('label'=>'Manage Mmcompany','url'=>array('admin')),
);
?>

<h1>Mmcompanies</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
