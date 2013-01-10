<div class="row-fluid">
	<div class="listed-info-item">
		<div class="listed-info-images">

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
		<div class="listed-info-text">
			<div class="list-item-header">
				<?php echo CHtml::link(
					CHtml::encode($data->name),
					array('search', 'Organization[directions][]' => $data->id)
					);
				?>
			</div>
			<div class="sub-info">
				<em>54</em> организации
			</div>
		</div>


	</div>

</div>
