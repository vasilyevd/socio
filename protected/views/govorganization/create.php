<?php
$this->breadcrumbs=array(
	'Govorganizations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Govorganization','url'=>array('index')),
	array('label'=>'Manage Govorganization','url'=>array('admin')),
);
?>

<h1>Create Govorganization</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>