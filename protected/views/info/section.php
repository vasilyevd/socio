<?php
//$this->contentClass = 'pading';
$this->sectionMain = "obj";
?>
<div class="row" style="margin-bottom: 20px;">

	<div class="span2">
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
			'type' => 'list', // '', 'tabs', 'pills' (or 'list')
			//'htmlOptions' => array('class' => 'well'), // bg for list
			'items' => $this->getInfoMenu($model)
		)); ?>
	</div>

	<div class="span10">
		<?php $this->widget('bootstrap.widgets.TbListView',array(
			'dataProvider' => $model->search(),
			'template' => '{items}{pager}',
			'htmlOptions'=>array('class'=>''),
			//'itemsCssClass' => 'row',
			'itemView' => '_view',
		)); ?>
	</div>


</div>