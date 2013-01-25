<div class="row-fluid">
	<div class="page-header">
		<div class="header-menu">
			<?php // echo CHtml::link('Создать организацию', array('organization/create'), array('class'=>'btn btn-colored')); ?>
		</div>
		<h4>Информация</h4>
	</div>
</div>

<div class="row">

	<div class="span2">
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
			'type' => 'list', // '', 'tabs', 'pills' (or 'list')
			//'htmlOptions' => array('class' => 'well'), // bg for list
			'items' => array_merge(array(
					array('label' => 'Контроль', 'url' => array('info/index')),
					array('label' => 'Власть', 'url' => array('info/section', 'id'=>2)),
					array('label' => 'Обучение', 'url' => array('info/section', 'id' =>3)),
					array('label' => 'Программы', 'url' => array('info/section', 'id' =>4)),
					array('label' => 'Инваспорт', 'url' => array('info/section', 'id' =>5)),
					array('label' => 'Инватуризм', 'url' => array('info/section', 'id' =>6)),
					//array('label' => 'Льготы', 'url' => array('info/section', 'id' =>7)),
				), $this->menu),
		)); ?>
	</div>

	<div class="span10">
	</div>


</div>