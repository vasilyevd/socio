<div class="row">
    <div class="span2">
        <?php if ($groupMarker != $data->group): ?>
            <strong><?php echo Lookup::item('ProblemGroup', $data->group); ?></strong>
        <?php endif; ?>
    </div>

    <div class="span2">
        <?php echo CHtml::link(
            CHtml::encode($data->name),
            array('search', 'Organization[problems]' => $data->id)
        ); ?>
    </div>

    <?php foreach ($data->organizationsList as $o): ?>
        <div class="span1">
            <?php echo CHtml::link(
                CHtml::image(
                    $o->getUploadUrl('logo', $o->logo),
                    'Organization logo'
                ),
                array('view', 'id' => $o->id),
                array(
                    'class' => 'thumbnail',
                    'rel' => 'tooltip',
                    'data-title' => CHtml::encode($o->name),
                )
            ); ?>
        </div>
    <?php endforeach; ?>
</div>

<?php $widget->viewData['groupMarker'] = $data->group; ?>
