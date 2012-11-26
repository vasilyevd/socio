<?php if ($groupMarker != $data->group): ?>
    </div>
    <strong><?php echo Lookup::item('ProblemGroup', $data->group); ?>:</strong>
    <div class="org-main-problem-group">
<?php endif; ?>

<?php echo CHtml::link(
    CHtml::encode($data->name),
    array('search', 'Organization[problems]' => $data->id)
); ?>
<br />

<?php $widget->viewData['groupMarker'] = $data->group; ?>
