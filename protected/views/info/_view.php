<div class="row-fluid">
	<?php
	$this->widget('ext.widgets.SHeader',array(
			'text'=>CHtml::link($data->title, array('/info/view', 'id'=>$data->id)),
			'menu'=>CHtml::link('подробнее...', array('/info/view', 'id'=>$data->id), array('class'=>'href')),
			'htmlOptions'=>array('style'=>'color:#000;'),
		)
	);
	?>

	<div>
	<?php echo $data->desc; ?>
	</div>
</div>
