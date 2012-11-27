<?php if ($groupMarker != $data->group): ?>
    <strong><?php echo Lookup::item('OrgtypeGroup', $data->group); ?>:</strong>
<?php endif; ?>

<?php echo CHtml::link(
    CHtml::encode($data->name),
    array('search', 'Organization[type]' => $data->id)
); ?>
<br>

<?php $widget->viewData['groupMarker'] = $data->group; ?>
