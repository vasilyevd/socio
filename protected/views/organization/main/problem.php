<?php if ($groupMarker != $data->group): ?>
	<?php // close tags for prev (if not first)
		if($groupMarker != 0) : ?>
			</div></div>
	<?php endif; ?>

	<div class="listed-group">
    <div class="list-item-header">
	    <?php echo Lookup::item('ProblemGroup', $data->group); ?>:
    </div>
    <div class="listed-group-items columns2">
<?php endif; ?>

<div class="listed-group-item">
	<?php
	echo CHtml::link(
	    CHtml::encode($data->name),
	    array('search', 'Organization[problems]' => $data->id)
	); ?>
</div>

<?php $widget->viewData['groupMarker'] = $data->group; ?>

<?php
 // close tags if last
	if($index == $count-1) : ?>
			</div></div>
<?php endif; ?>

