<?php
$this->breadcrumbs=array(
	'Govorganizations'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Govorganization','url'=>array('index')),
	array('label'=>'Create Govorganization','url'=>array('create')),
	array('label'=>'View Govorganization','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Govorganization','url'=>array('admin')),
);
?>

<h1>Update Govorganization <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>