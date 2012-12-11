<div class="row">
    <div class="span2">
        <?php echo CHtml::link(
            CHtml::encode($data->name),
            array('search', 'Organization[directions][]' => $data->id)
        ); ?>
    </div>

    <?php foreach ($data->organizationsList as $o): ?>
        <div class="span1">
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
        </div>
    <?php endforeach; ?>
</div>
