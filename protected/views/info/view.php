<?php
/** @var $model Infoitem */
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

		<div class="row-fluid">
			<?php
			$this->widget('ext.widgets.SHeader',array(
					'text'=>$model->title,
					'htmlOptions'=>array('style'=>'color:#000;'),
				)
			);
			?>

			<div class="text-block">
				<?php echo $model->full_text; ?>
			</div>
		</div>


	</div>


</div>