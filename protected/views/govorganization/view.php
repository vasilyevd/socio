<?php
$this->breadcrumbs=array(
	'Govorganizations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Govorganization','url'=>array('index')),
	array('label'=>'Create Govorganization','url'=>array('create')),
	array('label'=>'Update Govorganization','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Govorganization','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Govorganization','url'=>array('admin')),
);
?>

<h1>View Govorganization #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type_group',
		'type_id',
		'action_area',
		'city_id',
		'address_id',
		'foundation_year',
		'staff_size',
		'description',
		'goal',
		'website',
		'phone_num',
		'email',
		'logo',
		'logobg',
		'logobgset',
		'author_id',
		'create_time',
		'status',
		'verified',
	),
)); ?>
