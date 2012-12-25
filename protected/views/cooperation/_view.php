<div class="well well-small">
    <div class="row">
        <?php if (!empty($data->linkOrganization)): ?>
            <div class="org-logo-conteiner">
                <div class="span1">
                    <?php echo CHtml::link(
                        CHtml::image(
                            $data->linkOrganization->getUploadUrl('logo'),
                            'Лого организации'
                        ),
                        array('organization/view', 'id' => $data->linkOrganization->id),
                        array(
                            'class' => 'thumbnail',
                            'rel' => 'tooltip',
                            'data-title' => CHtml::encode($data->link),
                        )
                    ); ?>
                </div>

                <div class="span5">
                    <strong><?php echo CHtml::link(CHtml::encode($data->link),array('view','id'=>$data->id)); ?></strong>
                </div>
            </div>
        <?php else: ?>
            <div class="span5">
                <strong><?php echo CHtml::link(CHtml::encode($data->link),array('view','id'=>$data->id)); ?></strong>
            </div>
        <?php endif; ?>

        <div class="span8">
            <br />
            <?php echo CHtml::encode($data->description); ?>
        </div>
    </div>
</div>
