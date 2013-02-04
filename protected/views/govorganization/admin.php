<?php
$this->breadcrumbs=array(
	'Govorganizations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Govorganization','url'=>array('index')),
	array('label'=>'Create Govorganization','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('govorganization-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Govorganizations</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'govorganization-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'type_group',
		'type_id',
		'action_area',
		'city_id',
		/*
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
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
