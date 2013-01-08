<?php if ($groupMarker != $data->group): ?>
	    <?php //echo Lookup::item('OrgtypeGroup', $data->group).':'; ?>
<?php endif; ?>

<div>
<?php echo CHtml::link(
    CHtml::encode($data->name),
    array('search', 'Organization[type]' => $data->id)
); ?>
</div>

<?php $widget->viewData['groupMarker'] = $data->group; ?>
