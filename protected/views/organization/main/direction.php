<div class="row">
	<div>
		<div class="list-right-info-fixed" style="float: right;" >

			<?php foreach ($data->getLimitedOrgList(5) as $o): ?>
				<?php echo CHtml::link(
				CHtml::image(
					$o->getUploadUrl('logo'),
					'Organization logo'
				),
				array('view', 'id' => $o->id),
				array(
					'class' => 'thumbnail',
					'rel' => 'tooltip',
					'data-title' => CHtml::encode($o->name),
				)
			); ?>
			<?php endforeach; ?>

		</div>
		<div class="list-left-info">
			<?php echo CHtml::link(
			CHtml::encode($data->name),
			array('search', 'Organization[directions][]' => $data->id)
		);
			?>
		</div>


	</div>

</div>
