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
<!-- GLOBAL ROW -->
<div class="row">

	<!-- C1 -->
	<div class="span8">

		<!-- C1 R1 -->
		<div class="row show-grid">
			<!-- R1.1 -->
			<div class="span2">
				<img src="/images/other/orgmain.jpg" class="img-polaroid">
			</div>
			<!-- R1.2 -->
			<div class="span6">
				<p>Описание раздела</p>
				<p> Кнопка добавления своей организации</p>
			</div>
		</div>

	<!-- C1 R2 -->
	<div class="row">
		<!-- R2.1 -->
		<div class="span6">
				<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
					'title' => 'Категории',
					'headerIcon' => 'icon-th-list',
					//'htmlOptions' => array('class'=>'bootstrap-widget-table')
				));?>
					asdasdasd
				<?php $this->endWidget();?>
		</div>
		<!-- R2.2 -->
		<div class="span2">
				span2
		</div>

	</div>

	<!-- C1 R3 -->
	<div class="row">
	<div class="span8">
	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
		'title' => 'Проблематики',
		'headerIcon' => 'icon-th-list',
		//'htmlOptions' => array('class'=>'bootstrap-widget-table')
	));?>
	Список проблематик организаций
	<?php $this->endWidget();?>
	</div>
	</div>

</div>

<!-- C2 -->
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

</div>






