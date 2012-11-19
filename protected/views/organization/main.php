<?php
$this->layout='//layouts/main';

$this->breadcrumbs=array(
	'Организации',
);

$this->menu=array(
	array('label'=>'Create Organization','url'=>array('create')),
	array('label'=>'Manage Organization','url'=>array('admin')),
);

?>


<div class="span8">
	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
		'title' => 'Информационная часть',
		'headerIcon' => 'icon-th-list',
		//'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));?>
	<p>Описание раздела</p>
	<p> Кнопка добавления своей организации</p>
	<?php $this->endWidget();?>



	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
		'title' => 'Категории',
		'headerIcon' => 'icon-th-list',
		//'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));?>
	<p>Список категорий организаций<</p>
	<p> Название категории с неколькими аватарками организаций из этой категории (пока по дате добавления)</p>
	<?php $this->endWidget();?>


	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
		'title' => 'Проблематики',
		'headerIcon' => 'icon-th-list',
		//'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));?>
	Список проблематик организаций
	<?php $this->endWidget();?>


</div>

<div class="span4">

	<div class="well well-small">
		<?
		$this->widget('bootstrap.widgets.TbButton',array(
		'label' => 'Поиск организаций',
		'type'=>'link',
		'url'=>array('/organization/search'),
		'htmlOptions'=>array(
			'class'=>'btn-block',
		),
		));
		?>
	</div>

	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
		'title' => 'Последние события',
		'headerIcon' => 'icon-th-list',
		//'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));?>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<?php $this->endWidget();?>

</div>



<div class="span4">
	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
		'title' => 'Новые организации',
		'headerIcon' => 'icon-th-list',
		//'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));?>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<p>sdfgsdfgsdgfsdf ssdfsdf </p>
	<?php $this->endWidget();?>
</div>



